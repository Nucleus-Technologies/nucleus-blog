@php
    
    $bgs = \Illuminate\Support\Facades\Storage::url($post->hero);
    $bgs = blank($story->hero) ? asset("assets/img/header_bg.jpg") : $bgs;
    $writer = \App\Writer::find($post->writer);
    $published_at = date_create_from_format('Y-m-d h:i:s', $post->published_at);
    $date = new \App\Http\Controllers\Moment($published_at->getTimestamp());
    $hour = $date->format('h:i a');
    $date = $date->format('F d, Y');

@endphp

<div class="post">
    
    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
        <div class="img row u-full-width" style="background-image: url({{ $bgs }})">
        
        </div>
    </a>
    
    <div class="row content">
        <a class="similar_link" href="{{ route('posts.show', ['slug' => $post->slug]) }}"><h6 class="post-title u-full-width">{{ $post->title }}</h6></a>
        
        <span class="footer u-full-width">
            <span class="author">{{ $writer->first_name . ' ' . $writer->last_name }}</span>
            <span>|</span>
            <span class="date">{{ $date . ' at ' . $hour }}</span>
        </span>
    </div>

</div>
