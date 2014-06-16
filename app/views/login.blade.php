@extends('layouts.login')

@section('content')
	<!-- Creates the form -->
<?php $success = Session::get('success') ?>
@if($success)
            <div class="alert alert-error alert-danger">
        <h4>{{ $success }}</h4>
    </div>
@endif
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
    	@if ( Session::get('error') )
            <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if ( Session::get('notice') )
            <div class="alert alert-warning">{{{ Session::get('notice') }}}</div>
        @endif
		{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
		<br/>
		{{ Form::submit('Log in', array('class' => 'btn btn-lg btn-success btn-block')) }}
	{{ Form::close() }}
@stop