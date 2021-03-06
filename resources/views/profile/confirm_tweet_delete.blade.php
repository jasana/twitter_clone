@extends('master')

@section('title', 'Are you sure you want to delete this tweet')
@section('meta-description', 'Goodbye forever to your tweet')

@section('content')

<h1>Are you sure?</h1>
<p>You are about to <em>permanently</em> delete the following tweet: </p>

<div class="bg-info">
	<article class="tweet">
		<p>{{ $tweet->content }}</p>
		<small>Written by {{ $tweet->user->name }} on {{ $tweet->created_at }}</small>
	</article>
</div>

<a href="/profile/delete-tweet/{{ $tweet->id }}/confirm">Yes</a> | <a href="/profile/{{ $tweet->user->username }}">No, please take me back</a>


@endsection