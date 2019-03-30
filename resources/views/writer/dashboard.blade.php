@extends('layouts.writer')

@section('content')

<section class="stories">

	<div class="container">

		<div class="row title">
			<h4>Your Stories</h4>
		</div>

		<div class="row stories">
            
            @foreach ($stories as $story)
                @include('partials.story', ['story' => $story])
            @endforeach

		</div>

	</div>
	
</section>

@endsection
