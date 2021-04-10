<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liked_Video extends Model
{
    use HasFactory;
    protected $table = 'Liked_video';
    protected $fillable = ['id', 'created_at', 'updated_at', 'code_video'];

    static function getDataByOrder($column, $orderType){
        return Liked_Video::orderBy($column, $orderType)->get();
    }

    static function getAllData(){
        return Liked_Video::get();
    }

    static function addData($code){
        return Liked_Video::create(['code_video' => $code ]);
    }

    static function deleteData($videoID){
        return Liked_Video::where("code_video", "=", $videoID) -> delete();
    }

}
