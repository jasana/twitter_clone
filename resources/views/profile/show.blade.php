@extends('master')

@section('title', '')
@section('meta-description', '')

@section('content')

	<div class="page-header">
		<header id="user-profile">
			<img src="/profiles/{{ $user->profileImage }}" alt="" width="180">
			<h1>{{ $user->name }}</h1>
			<p>{{ $user->description }}</p>
			<ul>
				<li>Total tweets: {{ $user->tweets->count() }}</li>
				<li></li>
				<li></li>
			</ul>
		</header>
	</div>

	@if(count($errors))
		COMMENT FORM INVALID
	@endif

	@foreach( $userPosts as $tweet)
		<div class="bg-info">
			<article class="tweet">
			<hr>
				<p class="bg-info">{{ $tweet->content }}</p>
				<small class="bg-info">Posted: {{ $tweet->created_at }} by {{ $tweet->user->name }}</small>
				@if( \Auth::check() && $tweet->user->id == \Auth::user()->id )
					<a href="/profile/delete-tweet/{{ $tweet->id }}">Delete</a>
				@endif

				<h2>Comments: </h2>
				@if(\Auth::check())
				<form action="/profile/new-comment" method="post">
					{!! csrf_field() !!}
					<input type="hidden" name="tweet-id" value="{{ $tweet->id }}">
					<div>
						<label for="comment">Comment: </label>
						<textarea class="form-control" name="comment" id="comment" cols="3">{{ old('comment') }}</textarea>
					</div>
					<input class="btn btn-default" type="submit" value="Post">
				</form>
				@endif

				@forelse($tweet->comments as $comment)
					<article>
						<small>{{ $comment->user->name }} :</small>
						<p>{{ $comment->content }}</p>
					</article>
				@empty
					<small>No comments... Be the first to reply!</small>
				@endforelse
				<hr>
			</article>
		</div>
	@endforeach




@endsection