@php
    $created_at = $story->created_at->getTimestamp();
    $updated_at = date_create_from_format('Y-m-d h:i:s', $story->updated_at);
    
    if ($updated_at != null) {
        $today = new DateTime('now');
        $last_edited = date_diff($updated_at, $today)->days;
        $last = $last_edited > 0 ? $last_edited : "Last edited today";
    } else {
        $last = "Click to edit";
    }
    
    $published = $story->published_at != null ? 'Published' : 'Unpublished';
    
    $date = new \App\Http\Controllers\Moment($created_at);
@endphp

<div class="story">
    <div class="row date">
        <div class="six columns">
            <span>{{ $date->format('F d, Y') }}</span>
        </div>
        <div class="published six columns">
            <span>{{ $published }}</span>
        </div>
    </div>
    
    <div class="row title">
        <h5>{{ $story->title }}</h5>
    </div>
    
    <div class="row description">
        <p>
            {{ str_finish(str_limit($story->description, 190), '...') }}
        </p>
    </div>
    
    <div class="row post_button">
        <a href="{{ route('stories.edit', ['story' => $story->id]) }}">
            @if (is_int($last))
                <span>Last edited {{ $last }} {{ str_plural('day', $last) }} ago</span>
            @else
                <span>{{ $last }}</span>
            @endif
            
            <svg width="14.234" height="13.668" viewBox="0 0 14.234 13.668">
                <defs><style>.a{fill:none;stroke:#32908f;stroke-linecap:round;stroke-width:2px;}</style></defs><g transform="translate(1 1.406)"><line class="a" x2="11.828" transform="translate(0 5.428)"/><line class="a" x2="6.766" y2="5.428" transform="translate(5.062)"/><line class="a" y1="5.428" x2="6.766" transform="translate(5.062 5.428)"/></g>
            </svg>
        </a>
    </div>
</div>
