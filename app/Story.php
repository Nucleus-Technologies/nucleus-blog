<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'writer', 'category', 'slug', 'title', 'description', 'hero', 'content', 'published_at'
    ];
}
