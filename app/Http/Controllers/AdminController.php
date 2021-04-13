<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video_List;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class AdminController extends Controller
{
    public function get_HomeAdmin(){
        return view('admin.home-admin');
    }

    public function get_CudData(){
    	return view('admin.cud-video-admin', ['data' => Video_List::get_AllVideoListData()]);
    }

    public function get_TopVideoLikeData(){
        return view('admin.top-video-like', ['data' => Video_List::getDataByOrder('like_sum', 'desc')]);
    }

    public function get_TopVideoDislike(){
        return view('admin.top-video-dislike', ['data' => Video_List::getDataByOrder('dislike_sum', 'desc')]);
    }

    public function get_TopVideoWatch(){
        return view('admin.top-video-dislike', ['data' => Video_List::getDataByOrder('view_sum', 'desc')]);
    }

    public function setNewVideo(Request $request){
        $fileImg = $request->file('videoThumbnail');
        $filePathImg = "";

        $fileVideo = $request->file('videoFile');
        $filePathVideo = "";
       
        // harus nganggo public path -> src = https://stackoverflow.com/questions/52006508/file-move-function-not-showing-moved-file-in-the-new-folder
        $fileImg->move(public_path()."/thumbnail_list/", $request->code.".JPG");
        $fileVideo->move(public_path()."/video_sample/", $request->title.".mp4");

        $filePathImg = "/thumbnail_list/".$request->code.".JPG";
        $filePathVideo= "/video_sample/".$request->title.".mp4";

        //NOTE: upload_max_filesize in php.init in xampp apache config already changed from 2M to 20M
        Video_List::addNewData($request->code, $request->title, $request->simpleDesc, $request->videoDuration, $request->videoTag, $filePathImg, $filePathVideo);
        return redirect()->route('cud_admin');
    }

    public function getUpdateVideoPage($codeVideo){
        //var_dump($codeVideo);

        return view('admin.update-form-video-data', ['data' => Video_List::getSpecificData('code', $codeVideo)]);
    }

    public function setNewUpdateVideo(Request $request){
        $fileUpdate = $request->file('thumbnailFileUpdate');
        $filePathImg = "";

        if(isset($fileUpdate)){
            $filePathImg = "/thumbnail_list/".$request->codeUpdate.".JPG";
            $filePathImgDelete = public_path()."/thumbnail_list/".$request->codeUpdate.".JPG";

            if(File::exists($filePathImgDelete)) {
	            File::delete($filePathImgDelete);
	        }
            
            // harus nganggo public path -> src = https://stackoverflow.com/questions/52006508/file-move-function-not-showing-moved-file-in-the-new-folder
            $fileUpdate->move(public_path()."/thumbnail_list", $request->codeUpdate.".JPG");
            
        }else{
            $filePathImg = "";
        }
        
        Video_List::updateNewData($request->codeUpdate, $request->title, $request->simpleDesc, $request->likeUpdate, $request->dislikeUpdate, $request->totalViewUpdate, $request->videoTagUpdate, $filePathImg);
        
        return redirect()->route('cud_admin');
    }

    public function setDeleteVideoData($codeVideo){
        $data = Video_list::getSpecificData('code', $codeVideo);
        $filePathImg = public_path()."/thumbnail_list/".$codeVideo.".JPG";
        $filePathVideo = public_path()."/video_sample/".$data[0]->name.".mp4";

        if(File::exists($filePathImg)) {
            File::delete($filePathImg);
        }

        if(File::exists($filePathVideo)) {
            File::delete($filePathVideo);
        }

        Video_list::deleteData($codeVideo);

        return redirect()->route('cud_admin');
    }
}
