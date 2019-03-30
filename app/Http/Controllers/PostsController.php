<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Story;
use App\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    
    public function index()
    {
        return view('home');
    }
    
    public function category($category)
    {
        if ($category == 'technology')
            return view('blog.technology');
        else if ($category == 'education')
            return view('blog.education');
        else if ($category == 'health')
            return view('blog.health');
        else
            return view('home');
    }
    
    public function posts()
    {
        $category = request()->input('category');
        $posts = Story::all();
        $posts = $posts->where('published_at', '!=', null);
        
        if ($category != null && $category != 'home') {
            $posts = $posts->where('category', '=', $category);
        }
        
        $real = array();
        
        foreach ($posts as $post) {
            $bgs = Storage::url($post->hero);
            $bgs = blank($post->hero) ? asset("assets/img/header_bg.jpg") : $bgs;
            $writer = Writer::find($post->writer);
            $published_at = date_create_from_format('Y-m-d h:i:s', $post->published_at);
            $date = new Moment($published_at->getTimestamp());
            $hour = $date->format('h:i a');
            $date = $date->format('F d, Y');
            
            $type = rand(0, 3);
            
            if ($type == 0) {
                $content = "<div class=\"post\">
    
    <div class=\"row content\">
        <a class=\"similar_link\" href=".route('posts.show', ['slug' => $post->slug])."><h6 class=\"post-title u-full-width\">$post->title</h6></a>
        
        <span class=\"footer u-full-width\">
            <span class=\"author\">$writer->first_name $writer->last_name</span>
            <span>|</span>
            <span class=\"date\">$date at $hour</span>
        </span>
    </div>

</div>";
            } else if ($type == 1) {
                $content = "<div class=\"post\">
    
    <a href=".route('posts.show', ['slug' => $post->slug]).">
        <div class=\"img row u-full-width\" style=\"background-image: url($bgs)\">
        
        </div>
    </a>
    
    <div class=\"row content\">
        <a class=\"similar_link\" href=".route('posts.show', ['slug' => $post->slug])."><h6 class=\"post-title u-full-width\">$post->title</h6></a>
        
        <span class=\"footer u-full-width\">
            <span class=\"author\">$writer->first_name $writer->last_name</span>
            <span>|</span>
            <span class=\"date\">$date at $hour</span>
        </span>
    </div>

</div>";
            } else if ($type == 2) {
                $content = "<div class=\"post\">
    
    <a href=".route('posts.show', ['slug' => $post->slug]).">
        <div class=\"img row u-full-width\" style=\"background-image: url($bgs)\">
        
        </div>
    </a>
    
    <div class=\"row content\">
        <a class=\"similar_link\" href=".route('posts.show', ['slug' => $post->slug])."><h6 class=\"post-title u-full-width\">$post->title</h6></a>
        
        <p>".str_finish(str_limit($post->description, 190), '...')."</p>
        
        <span class=\"footer u-full-width\">
            <span class=\"author\">$writer->first_name $writer->last_name</span>
            <span>|</span>
            <span class=\"date\">$date at $hour</span>
        </span>
    </div>

</div>";
            } else if ($type == 3) {
                $content = "<div class=\"post\">
    
    <div class=\"row content\">
        <a class=\"similar_link\" href=".route('posts.show', ['slug' => $post->slug])."><h6 class=\"post-title u-full-width\">$post->title</h6></a>
        
        <p>".str_finish(str_limit($post->description, 190), '...')."</p>
        
        <span class=\"footer u-full-width\">
            <span class=\"author\">$writer->first_name $writer->last_name</span>
            <span>|</span>
            <span class=\"date\">$date at $hour</span>
        </span>
    </div>

</div>";
            }
            
            $real[] = $content;
        }
        
        return $real;
    }
    
    public function show($slug) {
        $story = Story::where('slug', $slug)->first();
        
        if ($story == null) return redirect()->route('home')->with('error', "Post with this title doesn't exists.");
        
        if ($story->published_at != null) {
            $writer = Writer::find($story->writer);
            $comments = Comment::all();
            $comments = $comments->where('story', '=', $story->id);
            $stories = Story::all()->take(3);
            $similar = [];
        
            foreach ($stories as $post) {
                if ($post->published_at != null && $post->id != $story->id && $post->category == $story->category)
                    $similar[$post->id] = $post;
            }
        
            if ($story->published_at != null) {
                $published_at = date_create_from_format('Y-m-d h:i:s', $story->published_at);
                $date = new Moment($published_at->getTimestamp());
                $hour = $date->format('h:i a');
                $date = $date->format('F d, Y');
            } else {
                $date = null;
                $hour = null;
            }
    
            $bg = Storage::url($story->hero);
            $bg = blank($story->hero) ? asset("assets/img/header_bg.jpg") : $bg;
            $avatar = Storage::url($writer->avatar);
            $avatar = blank($writer->avatar) ? asset("assets/img/author.png") : $avatar;
        
            $content = $story->content;
        
            return view('post', [
                'story' => $story,
                'writer' => $writer,
                'avatar' => $avatar,
                'hour' => $hour,
                'date' => $date,
                'content' => $content,
                'bg' => $bg,
                'comments' => $comments,
                'similar' => $similar
            ]);
        } else {
            return redirect()->route('home');
        }
    }
    
}
