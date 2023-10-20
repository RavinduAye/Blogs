<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'published_date'
    ];
}