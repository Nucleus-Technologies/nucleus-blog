<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'email', 'story', 'content', 'likes', 'created_at'
    ];
    
    public $timestamps = false;
}
