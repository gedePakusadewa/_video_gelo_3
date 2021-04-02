<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liked_Video extends Model
{
    use HasFactory;
    protected $table = 'Liked_video';
    protected $fillable = ['id', 'created_at', 'updated_at', 'code_video'];
}
