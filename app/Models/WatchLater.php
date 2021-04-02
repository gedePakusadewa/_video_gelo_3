<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchLater extends Model
{
    use HasFactory;
    protected $table = 'WatchLater';
    protected $fillable = ['id', 'created_at', 'updated_at', 'code_video'];
}
