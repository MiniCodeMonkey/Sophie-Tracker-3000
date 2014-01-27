@extends('layouts.master')

@section('content')
<div class="container">
	<h1><i class="icon-baby-baby"></i> <span style="color: {{ Config::get('sophietracker.color') }};">{{ Config::get('sophietracker.name') }}</span> Tracker 3000</h1>

	<h2>Login</h2>
	@if (Session::has('flash_error'))
	<div class="alert alert-danger">{{ Session::get('flash_error') }}</div>
	@endif

	{{ Form::open(array('role' => 'form')) }}

	<div class="form-group">
		{{ Form::label('mail', 'Email') }}
		{{ Form::text('mail', Input::old('mail'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password', array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
</div>
@stop