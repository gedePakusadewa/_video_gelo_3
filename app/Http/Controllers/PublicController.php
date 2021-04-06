<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video_List;
use App\Models\History_user;
use App\Models\Liked_Video;
use App\Models\WatchLater;
//use Illuminate\Database\Eloquent\Builder::all();

class PublicController extends Controller
{
    public function get_HomeData(){
        $data = Video_List::get();
        return view('home', ['data' => $data]);
    }

    public function get_TrendingData(){
        $data = Video_list::orderBy('view_sum', 'asc')->get();
        return view('trending', ['data' => $data]);
        //tambah fungsi pengecekan ada error ato sink
    }

    public function get_HistoryData(){        
        $dataRaw = History_user::orderBy('id', 'desc')->get();
        $finalData = array();
        $tmp = array();

        foreach($dataRaw as $item){
            $tmp = Video_List::where('code', '=', $item->code_video)->get()->toArray();
            $finalData = array_merge($finalData, $tmp);
        }

        //var_dump(count($tes));
   /*     for($i = 0; $i < count($tes); $i++){
            foreach($tes[$i] as $value){
                echo $value."<br />";
            }
            echo "<br />";
        } */

        /*foreach($tes as $key){
            echo $key['code'];
            echo "<br />";
        } */
        //$this->adding_history_data();
    	return view('history', ['finalData' => $finalData]);
    }
    
    public function get_WatchLaterData(){
    	return view('watch-later');
    }

    public function get_LikeVideoData(){
        $dataRaw = Liked_Video::orderBy('id', 'desc')->get();
        $finalData = array();
        $tmp = array();

        foreach($dataRaw as $item){
            $tmp = Video_List::where('code', '=', $item->code_video)->get()->toArray();
            $finalData = array_merge($finalData, $tmp);
        }

    	return view('like-video', ['finalData' => $finalData]);
        //$this->adding_liked_video_data();
    }

    public function get_SearchResultData(Request $request){
        $keyData = $request->input('searchInput');
        $result = array();

        //check if string result is only white spaces nothing else
        //src=https://stackoverflow.com/questions/46099157/php-find-if-a-string-contains-only-whitespaces-and-nothing-else
        if(!preg_match('/^\s*$/', $keyData)){
            //search multiple column in one query
            //https://stackoverflow.com/questions/48089966/how-to-get-search-query-from-multiple-columns-in-database
            $result = Video_List::
                where('name', 'LIKE', '%'.$keyData.'%')
                ->orWhere('simple_description', 'LIKE', '%'.$keyData.'%')
                ->orWhere('tag', 'LIKE', '%'.$keyData.'%')->get()->toArray();
        }
        return view('search-result', ['result' => $result]);
        //var_dump($result);
        //return view('search-result');
    }

    public function get_SettingsData(){

       //$this->adding_data();

        return view('settings');
    }

    public function get_AboutPage(){
        return view('about');
    }

    public function get_VideoData($videoID){
        $data = Video_List::where("code", "=", $videoID)->get();
        
        foreach($data as $item){
            $this->setTotalViewVideo($videoID, $item->view_sum);
            $this->setAllHistoryData($videoID);
        }

        return view('video_play_page', ['data' => $data]);

        //nanti tambah line untuk megnecek apakah ada error atao enggak trus kasi error message ke view
    }



    private function setTotalViewVideo($videoID, $totalViewsBefore){
        Video_List::where("code", "=", $videoID) -> update(["view_sum" => ((int)$totalViewsBefore + 1)]);
        //nanti tambah line untk mencek apkah data sudah masuk atau belum, jika belum apa yg harus dilakukan
    }

    private function adding_data(){
        $code = "dpeb78";
        $name = "Ambassador21 - We Are Legion (Matt Green Remix) Love Death Robots OST";
        $simple_desc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultrices, ex nec rhoncus consequat, nulla diam varius elit, sit amet pretium elit nunc eu ligula. Nulla nisl nunc, eleifend ac est ut, lobortis fermentum enim.";
        $like_sum = "3";
        $dislike_sum = "12";  
        $view_sum = "12";
        $duration = "156";
        $tag = "solo;england;pop";
        $thumbnail_path = "thumbnail_list/dpeb78.JPG";
        $video_path = "video_sample/A Day to Remember- Right Back At It Again.mp4";

        Video_List::create([
            'code' => $code,
            'name' => $name,
            'simple_description' => $simple_desc,
            'like_sum' => $like_sum,
            'dislike_sum' => $dislike_sum,
            'view_sum' => $view_sum,
            'duration' => $duration,
            'tag' => $tag,
            'thumbnail_path' => $thumbnail_path,
            'video_path' => $video_path
        ]);
    }

    private function adding_history_data(){
        $code = "kwolri";

        History_user::create([
            'code_video' => $code
        ]);
    }

    private function adding_liked_video_data($code){
        //$code = "zlayhe";

        Liked_Video::create([
            'code_video' => $code
        ]);
    }

    private function setAllHistoryData($codeVideo){
        $code = $codeVideo;

        History_user::create([
            'code_video' => $code
        ]);
    }

    public function set_LikedVideo($videoID){       

        if(!$this->isLikedByThisUser($videoID)){
            $data = Video_List::where("code", "=", $videoID)->get();
            foreach($data as $item){
                $this->setTotalLikedVideo($videoID, $item->like_sum, $item->dislike_sum);
            }
        }

        return $this->get_VideoDataLiked($videoID);
    }

    private function isLikedByThisUser($videoID){
        $data = Liked_Video::get();
        $status = false;
        foreach($data as $value){
            if($videoID === $value->code_video){
                $status = true;
                break;
            }
        }
        return $status;
    }

    private function setTotalLikedVideo($videoID, $totalLike, $totalDislike){
        Video_List::where("code", "=", $videoID) -> update(["like_sum" => ((int)$totalLike + 1)]);
        
        if((int)$totalDislike > 0){
            Video_List::where("code", "=", $videoID) -> update(["dislike_sum" => ((int)$totalDislike - 1)]);
        }

        $this->adding_liked_video_data($videoID);
        //nanti tambah line untk mencek apkah data sudah masuk atau belum, jika belum apa yg harus dilakukan
    }

    private function get_VideoDataLiked($videoID){
        $data = Video_List::where("code", "=", $videoID)->get();

        return view('video_play_page', ['data' => $data]);

        //nanti tambah line untuk megnecek apakah ada error atao enggak trus kasi error message ke view
    }

    public function set_DislikedVideo($videoID){
        if($this->isLikedByThisUser($videoID)){
            Liked_Video::where("code_video", "=", $videoID) -> delete();
            $data = Video_List::where("code", "=", $videoID)->get();
            foreach($data as $item){
                $this->setTotalDislikedVideo($videoID, $item->like_sum, $item->dislike_sum);
            }
        }
        return $this->get_VideoDataLiked($videoID);
    }

    private function setTotalDislikedVideo($videoID, $totalLike, $totalDislike){
        Video_List::where("code", "=", $videoID) -> update(["dislike_sum" => ((int)$totalDislike + 1)]);
        
        if((int)$totalLike > 0){
            Video_List::where("code", "=", $videoID) -> update(["like_sum" => ((int)$totalLike - 1)]);
        }
        //nanti tambah line untk mencek apkah data sudah masuk atau belum, jika belum apa yg harus dilakukan
    }

    public function set_WatchLater(){
        // Video_List::where("code", "=", "kwolri") -> update(["tag" => $_POST['data1']]);
        // return;
        WatchLater::create([
            'code_video' => $_POST['code']
        ]);
        return;
        //return view('watch-later');
    }


}
