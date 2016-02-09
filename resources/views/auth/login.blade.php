@extends('master')

@section('title', 'Log in')
@section('meta-description', 'Login to your account to allow full access')

@section('content')

<h1>Login</h1>

<form action="/login" method="post">

	{!! csrf_field() !!}

	<div class="form-group">
		<label for="email">E-Mail: </label>
		<input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="example@mail.com">
	</div>
	<div class="form-group">
		<label for="password">Password: </label>
		<input class="form-control" type="password" name="password" id="password">
	</div>

	<input class="btn btn-default" type="submit" value="Login!">

</form>

@if(count($errors))

<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

@endif

@endsection