@extends('layouts.writer')

@section('content')

<section class="container">
	
	<form id="story_form" action="{{ route('stories.update', ['story' => $story->id]) }}" enctype="multipart/form-data" method="POST">
		
        @csrf
        @method('PUT')
        
		<div class="row">
			<div class="four columns">
				
				<div class="row config story_config">
					
					<div class="row config_title">
						<span>Story Informations</span>
						<hr>
					</div>
					
					<div class="row content" style="flex-direction: column">
						<div class="row u-full-width">
							<input type="text" name="title" id="title" placeholder="Story title" value="{{ $story->title }}">
						</div>
                        <div class="row u-full-width">
                            <select name="category" id="category">
                                <option value="">Category</option>
                                <option @if($story->category == 'technology') selected @endif value="technology">Technology</option>
                                <option @if($story->category == 'education') selected @endif value="education">Education</option>
                                <option @if($story->category == 'health') selected @endif value="health">Health</option>
                            </select>
                        </div>
						<div class="row u-full-width">
							<textarea name="description" id="description" cols="30" rows="10" placeholder="Story description">{{ $story->description }}</textarea>
						</div>
						<div class="row u-full-width">
							<input type="file" accept="image/*" name="hero" id="hero" style="display: none;">
						</div>
					</div>
					
					<div class="row config_save">
						<a href="#" class="hero_btn">
							Select story hero image
							
							<img src="/assets/img/green_arrow.svg" alt="arrow">
						</a>
					</div>
				
				</div>
			
			</div>
			<div class="eight columns">
				<div class="row editor config">
					<textarea name="editor" id="editor" cols="30" rows="10">
						 {{ $story->content }}
					</textarea>
					
					<div class="row config_save">
						<a href="#" class="save_story_btn">
							Save
							
							<img src="/assets/img/green_arrow.svg" alt="arrow">
						</a>
					</div>
				</div>
			</div>
		</div>
	
	</form>

</section>

@endsection
