<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video_List;

class AdminController extends Controller
{
    public function get_HomeAdmin(){
        return view('admin.home-admin');
    }

    public function get_CudData(){
    	return view('admin.cud-video-admin', ['data' => Video_List::get_AllVideoListData()]);
    }

    public function get_TopVideoLikeData(){
    	return view('admin.top-video-like');
    }

    public function get_TopVideoDislike(){
    	return view('admin.top-video-dislike');
    }

    public function get_TopVideoWatch(){
    	return view('admin.top-video-watch');
    }
}
