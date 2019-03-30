<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Story;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    
    public function comment($id)
    {
        $story = Story::find($id);
        $data = request()->except('_token');
        $data['story'] = $story->id;
        $data['likes'] = 0;
        $data['created_at'] = now();
    
        $comment = new Comment($data);
    
        if (!$comment->save()) {
            return redirect()->route('stories.show', ['story' => $story])->with('error', "Unable to add your comment.");
        }
    
        return redirect()->route('stories.show', ['story' => $story])->with('success', "Comment added successfully.");
    }
    
    public function like($story, $comment)
    {
        $comment = Comment::find($comment);
        
        $comment->likes++;
        $comment->update();
        
        return redirect()->route('stories.show', ['story' => $story]);
    }
    
}
