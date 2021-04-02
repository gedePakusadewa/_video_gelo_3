<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_user extends Model
{
    use HasFactory;
    protected $table = 'History_user';
    protected $fillable = ['id', 'created_at', 'updated_at', 'code_video'];

}
