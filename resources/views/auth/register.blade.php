@extends('master')

@section('title', 'Register a new account')
@section('meta-description', 'Accounts will give you full access to the website')

@section('content')

<h1>Register a new account</h1>


<form action="/register" method="post">

	{!! csrf_field() !!}

	<div class="form-group">
		<label for="name">Full Name: </label>
		<input class="form-control" type="text" name="name" id="name" placeholder="John Smith">
	</div>
	<div class="form-group">
		<label for="username">Username: </label>
		<input class="form-control" type="text" name="username" id="username" placeholder="jonny12">
	</div>
	<div class="form-group">
		<label for="email">E-Mail: </label>
		<input class="form-control" type="email" name="email" id="email" placeholder="example@mail.com">
	</div>
	<div class="form-group">
		<label for="password">Password: </label>
		<input class="form-control" type="password" name="password" id="password">
	</div>
	<div class="form-group">
		<label for="password_confirmation">Confirm password: </label>
		<input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
	</div>
	<input class="btn btn-default" type="submit" value="Register!">

</form>

@if(count($errors))

<ul>
	@foreach($errors->all() as $error)
		<li class="text-danger">{{ $error }}</li>
	@endforeach
</ul>

@endif



@endsection