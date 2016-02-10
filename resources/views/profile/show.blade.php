@extends('master')

@section('title', '')
@section('meta-description', '')

@section('content')

	<div class="page-header">
		<header id="user-profile">
			<img src="" alt="" width="120" height="120">
			<h1>{{ $user->name }}</h1>
			<p>{{ $user->description }}</p>
			<ul>
				<li>Total tweets: {{ $user->tweets->count() }}</li>
				<li></li>
				<li></li>
			</ul>
		</header>
	</div>

	@foreach( $userPosts as $tweet)
<div>
	<article class="tweet">
		<p class="bg-info">{{ $tweet->content }}</p>
		<small class="bg-info">Posted: {{ $tweet->created_at }} by {{ $tweet->user->name }}</small>
	</article>
</div>
	@endforeach




@endsection