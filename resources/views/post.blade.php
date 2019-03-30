<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/assets/css/ivy.css">
	<link rel="stylesheet" href="/assets/css/all.css">
	<link rel="stylesheet" href="/assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/css/froala_style.min.css" rel="stylesheet" type="text/css" />
	<title>{{ $story->title }}</title>
</head>
<body class="post_page">
	
	<!-- Header -->
	<header style="background-image: url({{ $bg }});">

		<div class="shadow"></div>

		<div class="container">

			<div class="post_nav row">
				<div class="six columns post_author">

					<div class="author">
						<img src="{{ $avatar }}" alt="author">

						<div class="details">
							<span class="name">{{ $writer->first_name . ' ' . $writer->last_name }}</span>

							<div class="date">
								<span class="hour">Published {{ $hour }}</span>
								<hr>
								<span class="day">{{ $date }}</span>
							</div>
						</div>
					</div>

				</div>
				<div class="six columns close_post">
					<a href="/">
						<svg width="70.887" height="70.887" viewBox="0 0 70.887 70.887">
                            <defs>
                                <style>.a{fill:#f7f7f9;}.b{fill:none;stroke:#200116;stroke-linecap:round;stroke-width:2px;}.c{filter:url(#a);}</style>
                                <filter id="a" x="0" y="0" width="70.887" height="70.887" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="b"/><feFlood flood-opacity="0.161"/><feComposite operator="in" in2="b"/><feComposite in="SourceGraphic"/></filter>
                            </defs>
                            <g transform="translate(-199 -287)"><g class="c" transform="matrix(1, 0, 0, 1, 199, 287)"><circle class="a" cx="26.443" cy="26.443" r="26.443" transform="translate(9 6)"/></g><g transform="translate(231.063 315.378)"><line class="b" x2="8.271" y2="8.36" transform="translate(0)"/><line class="b" x1="8.271" y2="8.36" transform="translate(0)"/></g>
                            </g>
                        </svg>
					</a>
				</div>
			</div>

			<div class="title">
				<h1>{{ $story->title }}</h1>
			</div>

			<div class="socials">

				<div class="six columns likes">
					<a href="{{ route('stories.like', ['story' => $story->id]) }}" class="social_btn">
						<i class="fas fa-bookmark"></i>
					</a>

					<div class="count">
						<span class="number">{{ $story->likes }}</span>
						<span>Likes</span>
					</div>
				</div>

				<div class="six columns network">
					<a href="https://www.facebook.com/sharer.php?u={{ request()->url() }}" class="social_btn">
						<i class="fab fa-facebook"></i>
					</a>

					<a href="https://twitter.com/intent/tweet?url={{ request()->url() }}&text={{ $story->title }}" class="social_btn">
						<i class="fab fa-twitter"></i>
					</a>
				</div>

			</div>

			<div class="description">
				<p>
                    {{ $story->description }}
                </p>
			</div>

		</div>

	</header>

	<section class="post_content">

		<div class="container fr-view">

			@php
			    echo htmlspecialchars_decode($story->content);
			@endphp

		</div>

	</section>

	<section class="comments">

		<div class="container">

			<div class="row title">
				<h3>Comments</h3>
				<hr>
			</div>

			<div class="row comment_form">

				<form action="{{ route('comments.comment', ['story' => $story->id]) }}" method="POST">
                    
                    @csrf

					<div class="row u-full-width">
						<input type="text" name="author" id="author" class="u-full-width" placeholder="Enter your name">
					</div>

					<div class="row u-full-width">
						<input type="email" name="email" id="email" class="u-full-width" placeholder="Enter your email">
					</div>

					<div class="row u-full-width">
						<textarea name="content" id="content" cols="30" rows="10" class="u-full-width" placeholder="Enter your message"></textarea>
					</div>

					<div class="row button_row">
						<button type="submit" class="cta">
							COMMENT
							<img src="/assets/img/dark_arrow.svg" alt="arrow">
						</button>
					</div>

				</form>

			</div>

			<div class="row comments">
                
                @foreach ($comments as $comment)
                    @include('partials.comment', ['comment' => $comment])
                @endforeach

			</div>

		</div>

	</section>

    @if (count($similar) > 0)
    
        <section class="similar">
    
            <div class="container">
    
                <div class="row title">
                    <h3>Similar posts</h3>
                    <hr>
                </div>
            
                <div class="row posts">
    
                    @foreach ($similar as $post)
                        
                        @php
        
                            $bgs = \Illuminate\Support\Facades\Storage::url($post->hero);
                            $bgs = blank($bgs) ? "header_bg.jpg" : $bgs;
                            $writer = \App\Writer::find($post->writer);
                            $published_at = date_create_from_format('Y-m-d h:i:s', $post->published_at);
                            $date = new \App\Http\Controllers\Moment($published_at->getTimestamp());
                            $hour = $date->format('h:i a');
                            $date = $date->format('F d, Y');
                        
                        @endphp
                        
                        <div class="post four columns">
        
                            <a href="{{ route('stories.show', ['story' => $post->id]) }}">
                                <div class="img row u-full-width" style="background-image: url({{ $bgs }})">
                                
                                </div>
                            </a>
                            
                            <div class="row content">
                                <a class="similar_link" href="{{ route('stories.show', ['story' => $post->id]) }}"><h6 class="post-title u-full-width">{{ $post->title }}</h6></a>
                                
                                <p>{{ str_finish(str_limit($post->description, 190), '...') }}</p>
                                
                                <span class="footer u-full-width">
                                <span class="author">{{ $writer->first_name . ' ' . $writer->last_name }}</span>
                                <span>|</span>
                                <span class="date">{{ $date . ' at ' . $hour }}</span>
                            </span>
                            </div>
                        
                        </div>
                        
                    @endforeach
                    
                </div>
    
            </div>
        </section>
        
    @endif

	<!-- Footer -->
	<footer>

		<div class="row top">

			<div class="three columns">
				<img src="/assets/img/logo.svg" alt="logo" class="logo">
			</div>
			<div class="three columns">
				<div class="row">
					<h6>Where are we?</h6>
				</div>
				<div class="row">
					<p>Cameroon, Yaoundé<br>Biyem Assi, 44a/2</p>
				</div>
			</div>
			<div class="three columns">
				<div class="row">
					<h6>Contact</h6>
				</div>
				<div class="row">
					<a href="tel:+237695127550">
						<p>+237 695 127 550</p>
					</a>

					<a href="mailto:nucleustech@contact.com">
						<p>nucleus@contact.com</p>
					</a>
				</div>
			</div>
			<div class="three columns">
				<div class="row">
					<h6>Follow us</h6>
				</div>
				<div class="row socials">
						<a href="#"><span>GH</span></a>
						<a href="#"><span>IG</span></a>
						<a href="#"><span>TW</span></a>
						<a href="#"><span>FB</span></a>
				</div>
			</div>

		</div>

		<hr>

		<div class="row bottom">

			<div class="six columns">
				<span>All rights reserved. Copyright &copy; 2019.</span>
			</div>

			<div class="terms six columns">
				<a href="#">Privacy</a>
				<a href="#">Terms</a>
				<hr>
				<span>&copy; 2019 NT.</span>
			</div>

		</div>

	</footer>
    
    @include('partials.alert')

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/scrollreveal.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
