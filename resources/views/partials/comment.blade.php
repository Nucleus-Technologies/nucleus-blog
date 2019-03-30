@php
    $date = new \App\Http\Controllers\Moment($comment->created_at);
@endphp

<div class="row comment">
    
    <div class="row comment_details">
        
        <div class="six columns">
            <div class="author">
                <div class="details">
                    <span class="name">{{ $comment->author }}</span>
                    
                    <div class="date">
                        <span class="day">{{ $date->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="six columns round_btn">
            <span class="number">{{ $comment->likes }}</span>
            <a href="{{ route('comments.like', ['story' => $story->id, 'comment' => $comment->id]) }}" class="social_btn">
                <i class="fas fa-heart"></i>
            </a>
        </div>
    
    </div>
    
    <div class="row comment_content">
        <p>
            {{ $comment->content }}
        </p>
    </div>

</div>
