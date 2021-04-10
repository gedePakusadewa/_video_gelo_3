<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video_List;
use App\Models\History_user;
use App\Models\Liked_Video;
use App\Models\WatchLater;
use Illuminate\Support\Str;
//use Illuminate\Database\Eloquent\Builder::all();

class PublicController extends Controller
{ 
    public function get_HomeData(){
        $data = Video_List::get_AllVideoListData();
        foreach($data as $item){
            //to shorten video title character
            $item->name = Str::limit($item->name, 40);
            $item->created_at = $item->created_at->format('Y-m-d');
        }   
        return view('home', ['data' => $data]);
    }

    //lanjut memisahkan fungsi shorten title video ajak conversi date menjadi function terpisah
    //lanjut ngai page admin and the rest of admin things

    public function get_TrendingData(){
        return view('trending', ['data' => Video_List::getDataByOrder('view_sum', 'asc')]);
        //kondisi error -> tidak ada data
    }

    public function get_HistoryData(){        
        $finalData = array();

        foreach(History_user::getAllHistoryData() as $item){
            $finalData = array_merge($finalData, Video_List::getSpecificData('code', $item->code_video)->toArray());
        }

        //lanjut mengedit bagianne sesuai neh https://github.com/alexeymezenin/laravel-best-practices#fat-models-skinny-controllers

    	return view('history', ['finalData' => $finalData]);
    }
    
    public function get_LikeVideoData(){
        $finalData = array();

        foreach(Liked_Video::getDataByOrder('id', 'desc') as $item){
            $finalData = array_merge($finalData, Video_List::getSpecificData('code', $item->code_video)->toArray());
        }

    	return view('like-video', ['finalData' => $finalData]);
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

    public function set_LikedVideo($videoID){       

        if(!$this->isLikedByUser($videoID)){
            foreach(Video_List::getSpecificData('code', $videoID) as $item){
                $this->setTotalLikedVideo($videoID, $item->like_sum, $item->dislike_sum);
            }
        }

        return $this->get_VideoDataLiked($videoID);
    }

    private function isLikedByUser($videoID){
        foreach(Liked_Video::getAllData() as $value){
            if($videoID === $value->code_video){
               return true;
            }
        }
        return false;
    }

    private function setTotalLikedVideo($videoID, $totalLike, $totalDislike){
 
        Video_List::updateData('code', $videoID, 'like_sum', ((int)$totalLike + 1));

        if((int)$totalDislike > 0){
            Video_List::updateData('code', $videoID, 'dislike_sum', ((int)$totalDislike - 1));
        }

        Liked_Video::addData($videoID);
        //nanti tambah line untk mencek apkah data sudah masuk atau belum, jika belum apa yg harus dilakukan
    }

    private function get_VideoDataLiked($videoID){
        return view('video_play_page', ['data' => Video_List::getSpecificData("code", $videoID)]);
        //nanti tambah line untuk megnecek apakah ada error atao enggak trus kasi error message ke view
    }

    public function set_DislikedVideo($videoID){
        if($this->isLikedByUser($videoID)){
            Liked_Video::deleteData($videoID);
            foreach(Video_List::getSpecificData("code", $videoID) as $item){
                $this->setTotalDislikedVideo($videoID, $item->like_sum, $item->dislike_sum);
            }
        }
        return $this->get_VideoDataLiked($videoID);
    }

    private function setTotalDislikedVideo($videoID, $totalLike, $totalDislike){
        Video_List::updateData('code', $videoID, 'dislike_sum', ((int)$totalDislike + 1));
        
        if((int)$totalLike > 0){
            Video_List::updateData('code', $videoID, 'like_sum', ((int)$totalLike - 1));
        }
        //nanti tambah line untk mencek apkah data sudah masuk atau belum, jika belum apa yg harus dilakukan
    }

    public function set_WatchLater(){
        WatchLater::addData('code_video', $_POST['code']);
        return;
    }

    public function get_WatchLaterData(){
        $finalData = array();

        foreach(WatchLater::getDataByOrder('id', 'desc') as $item){
            $finalData = array_merge($finalData, Video_List::getSpecificData('code', $item->code_video)->toArray());
        }
        return view('watch-later', ['finalData' => $finalData]);
    }


}
