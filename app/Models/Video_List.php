<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video_List extends Model
{
    use HasFactory;
 
    protected $table = 'Video_List';
    protected $fillable = ['id', 'created_at', 'updated_at', 'code', 'name', 'simple_description', 'like_sum', 'dislike_sum', 'view_sum', 'duration', 'tag', 'thumbnail_path', 'video_path'];
}
