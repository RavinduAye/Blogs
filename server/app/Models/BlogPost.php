<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class BlogPost extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'published_date',
        'created_by'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
