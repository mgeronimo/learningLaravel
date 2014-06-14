@extends('layouts/login')
@section('content')
<?php $success = Session::get('success') ?>
@if($success)
    <div class="alert-box success">
        <h2>{{ $success }}</h2>
    </div>
@endif


<?php $user = User::find($id); ?>

<br>

{{ Form::open(['method' => 'PATCH', 'route' => 'user.update'])}}
<h3>Username</h3>
{{Form::text('username', $user->username,  array('required'=>'required'))}}

<h3>First Name</h3>
{{Form::text('fname', $user->fname,  array('required'=>'required')) }}

<h3>Last Name </h3>
{{Form::text('lname', $user->lname,  array('required'=>'required')) }}

<h3>Email</h3>
{{Form::email('email', $user->email,  array('required'=>'required')) }}

{{Form::hidden('id', $user->id,  array('required'=>'required')) }}
<h3>Password</h3>
{{Form::password('password',  array('required'=>'required')) }}

<h3>Confirm Password</h3>
{{Form::password('confirmpassword',  array('required'=>'required'))}}
<br>
<br>
	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}

	<br>
	<br>
	<div>
		<br>
		<a href="{{ URL::to('/') }}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Back</a>
		<br><br>
	</div>

@stop