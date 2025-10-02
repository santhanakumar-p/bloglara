<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Post extends Model
{
    use Commentable;

    protected $fillable = [
        'user_id',
        'user_name',
        'title',
        'image',
        'published_at',
        'content',
    ];
}
