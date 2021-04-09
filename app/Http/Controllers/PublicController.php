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
        return view('home', ['data' => Video_List::get_AllVideoListData()]);
    }

    public function get_TrendingData(){
        return view('trending', ['data' => Video_List::getDataByOrder('view_sum', 'asc')]);
        //kondisi error -> tidak ada data
    }

    public function get_HistoryData(){        
        $finalData = array();
        $tmp = array();

        foreach(History_user::getAllHistoryData() as $item){
            $tmp = Video_List::getSpecificData('code', $item->code_video)->toArray();
            $finalData = array_merge($finalData, $tmp);
        }

        //lanjut mengedit bagianne sesuai neh https://github.com/alexeymezenin/laravel-best-practices#fat-models-skinny-controllers

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
    	return view('history', ['finalData' => $finalData]);
    }
    
    public function get_LikeVideoData(){
        $finalData = array();
        $tmp = array();

        foreach(Liked_Video::getDataByOrder('id', 'desc') as $item){
            $tmp = Video_List::getSpecificData('code', $item->code_video)->toArray();
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
    }

    public function get_SettingsData(){

       //$this->adding_data();

        return view('settings');
    }

    public function get_AboutPage(){
        return view('about');
    }

    public function get_VideoData($videoID){
        $data = Video_List::getSpecificData("code", $videoID);
        
        foreach($data as $item){
            Video_List::updateData('code', $videoID, 'view_sum', ((int)$item->view_sum + 1));
            History_user::setNewData('code_video', $videoID);
        }

        return view('video_play_page', ['data' => $data]);

        //nanti tambah line untuk megnecek apakah ada error atao enggak trus kasi error message ke view
    }

    private function adding_liked_video_data($code){
        //$code = "zlayhe";

        Liked_Video::create([
            'code_video' => $code
        ]);
    }

    public function set_LikedVideo($videoID){       

        if(!$this->isLikedByUser($videoID)){
            foreach(Video_List::getSpecificData('code', $videoID) as $item){
                $this->setTotalLikedVideo($videoID, $item->like_sum, $item->dislike_sum);
            }
        }

        return $this->get_VideoDataLiked($videoID);
    }

    private function isLikedByUser($videoID){
        $status = false;
        foreach(Liked_Video::getAllData() as $value){
            if($videoID === $value->code_video){
                $status = true;
                break;
            }
        }
        return $status;
    }

    private function setTotalLikedVideo($videoID, $totalLike, $totalDislike){
        //Video_List::where("code", "=", $videoID) -> update(["like_sum" => ((int)$totalLike + 1)]);
        Video_List::updateData('code', $videoID, 'like_sum', ((int)$totalLike + 1));
        //lanjut beberes functionne, lanjut ganti/hilangkan baris yg bisa dioptinalkan
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
        WatchLater::create([
            'code_video' => $_POST['code']
        ]);
        return;
    }

    public function get_WatchLaterData(){
        $dataRaw = WatchLater::orderBy('id', 'desc')->get();
        $finalData = array();
        $tmp = array();

        foreach($dataRaw as $item){
            $tmp = Video_List::where('code', '=', $item->code_video)->get()->toArray();
            $finalData = array_merge($finalData, $tmp);
        }

        return view('watch-later', ['finalData' => $finalData]);
    }


}
