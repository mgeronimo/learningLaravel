@extends('layouts.login')

@section('content')
	<!-- Creates the form -->
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
    	
		{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
		<br/>
		{{ Form::submit('Log in', array('class' => 'btn btn-lg btn-success btn-block')) }}
	{{ Form::close() }}
@stop