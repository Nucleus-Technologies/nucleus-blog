<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Story;
use App\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::all();
        $stories = $stories->where('writer', '=', auth()->user()->id);
    
        return view('writer.stories.index', ['writer' => auth()->user(), 'page' => 'stories.index', 'stories' => $stories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('writer.stories.create', ['writer' => auth()->user(), 'page' => 'stories.create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required|min:50',
            'hero' => 'required',
            'editor' => 'required'
        ]);
        
        $writer = auth()->user();
        
        $data = $request->only('title', 'category', 'description');
        $data['writer'] = $writer->id;
        $data['slug'] = str_slug($data['title']);
        $data['content'] = htmlspecialchars($request->input('editor'));
        $data['published_at'] = $request->has('published') && $request->input('published') == true ? now() : null;
        
        if (filled($request->allFiles())) {
            if ($hero = $request->file('hero')->storePublicly('public')) {
                $data['hero'] = $hero;
            } else {
                return redirect()->route('stories.create')->with('error', "Unable to save your story.");
            }
        } else {
            return redirect()->route('stories.create')->with('error', "You must specify an hero image for your story.");
        }
        
        $story = new Story($data);
        
        if ($story->save()) {
            return redirect()->route('stories.edit', ['story' => $story])->with('success', "Story saved!");
        } else {
            return redirect()->route('stories.create')->with('error', "Unable to save your story.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Story::find($id);
        $writer = Writer::find($story->writer);
        $comments = Comment::all();
        $comments = $comments->where('story', '=', $story->id);
        $stories = Story::all()->take(3);
        $similar = [];
        
        foreach ($stories as $post) {
            if ($post->published_at != null && $post->id != $id && $post->category == $story->category)
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $story = Story::find($id);
        $story->content = htmlspecialchars_decode($story->content);
        return view('writer.stories.edit', ['story' => $story, 'writer' => auth()->user(), 'page' => 'stories.edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'editor' => 'required'
        ]);
    
        $story = Story::find($id);
    
        $data = $request->only('title', 'category', 'description');
        $data['slug'] = str_slug($data['title']);
        $data['content'] = htmlspecialchars($request->input('editor'));
        
        if (filled($request->allFiles())) {
            if ($hero = $request->file('hero')->storePublicly('public')) {
                $data['hero'] = $hero;
            } else {
                return redirect()->route('stories.edit', ['temp' => $temp])->with('error', "Unable to update your story.");
            }
        }
        
        if ($story->update($data)) {
            return redirect()->route('stories.edit', ['story' => $story])->with('success', "Story updated!");
        } else {
            return redirect()->route('stories.edit', ['story' => $story])->with('error', "Unable to update your story.");
        }
    }
    
    /**
     * Publish or unpublish story.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id)
    {
        $story = Story::find($id);
        $today = new Moment();
        $today = $today->format('Y-m-d h:i:s');
        
        $story->published_at = $story->published_at != null ? null : $today;
        
        if ($story->update()) {
            if ($story->published_at == null)
                return redirect()->route('stories.index')->with('success', "Story unpublished!");
            else
                return redirect()->route('stories.index')->with('success', "Story published!");
        } else {
            if ($story->published_at == null)
                return redirect()->route('stories.edit', ['story' => $story])->with('error', "Unable to unpublish your story");
            else
                return redirect()->route('stories.edit', ['story' => $story])->with('error', "Unable to publish your story");
        }
    }
    
    public function upload()
    {
        foreach (request()->allFiles() as $file) {
            
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            }
    
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $file->getFilename())) {
                header("HTTP/1.0 500 Invalid file name.");
                return;
            }
    
            if (!in_array(strtolower($file->getExtension()), array("gif", "jpg", "png"))) {
                header("HTTP/1.0 500 Invalid extension.");
                return;
            }
            
            $path = $file->storePubliclyAs('public/stories', $file->getFilename());
            
            echo json_encode(['location' => $path]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);
        
        if (!$story->delete()) {
            return redirect()->route('stories.edit', ['story' => $story])->with('error', "Unable to delete story.");
        }
    
        return redirect()->route('stories.index')->with('success', "Story deleted!");
    }
    
    public function like($id)
    {
        $story = Story::find($id);
        
        $story->likes++;
        $story->update();
        
        return redirect()->route('stories.show', ['story' => $story->id]);
    }
}
