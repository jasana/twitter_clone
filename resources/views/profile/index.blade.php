@extends('master')

@section('title', 'Account')
@section('meta-description', 'Welcome to your account page')

@section('content')

<h1>Hi there {{ \Auth::user()->name }}</h1>

<h2>Account stats</h2>
<ul>
	<li>Total Tweets: {{ $totalTweets }}</li>
</ul>

	<h4>Add a new profile image!</h4>

	<form action="/profile/new-profile-image" method="post" enctype="multipart/form-data">

		{!! csrf_field() !!}
		<div class="form-group">
			<input class="form-control" type="file" name="photo" required>
		</div>
		<input type="submit" value="Upload!">
	</form>


<h2>Write a new Tweet</h2>

<form action="/profile/new-tweet" method="post">

	{!! csrf_field() !!}

	<div>
		<label for="content">Tweet: </label>
		<textarea class="form-control" name="content" id="content" cols="3">{{ old('content') }}</textarea>
	</div>

	<input class="btn btn-default" type="submit" value="Post">
</form>

@if(count($errors))
	<ul>
		@foreach($errors->all() as $error)
			<li class="text-danger">{{ $error }}</li>
		@endforeach
	</ul>
@endif




@endsection