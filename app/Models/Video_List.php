<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video_List extends Model
{
    use HasFactory;
 
    protected $table = 'Video_List';
    protected $fillable = ['id', 'created_at', 'updated_at', 'code', 'name', 'simple_description', 'like_sum', 'dislike_sum', 'view_sum', 'duration', 'tag', 'thumbnail_path', 'video_path'];

    static function get_AllVideoListData(){
        return Video_List::get();
    }

    static function getDataByOrder($column, $orderType){
        return Video_list::orderBy($column, $orderType)->get();
    }


    static function getSpecificData($column, $data){
        return Video_List::where($column, '=', $data)->get();
    }

    //(UPDATE) add total view to specific video
    static function updateData($code, $dataID, $updatedColumn, $dataUpdated){
        return Video_List::where($code, "=", $dataID) -> update([$updatedColumn => $dataUpdated]);
    }



    static function addDataSample(){
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




    //lanjut cari apakah mengngunakan method static di model to baik ape sink
}
