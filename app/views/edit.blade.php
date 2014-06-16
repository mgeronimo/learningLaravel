@extends('layouts/login')
@section('content')
<?php $success = Session::get('success') ?>
@if($success)
            <div class="alert alert-error alert-danger">
        <h4>{{ $success }}</h4>
    </div>
@endif


<?php $user = User::find($id); ?>

<br>

{{ Form::open(['method' => 'PATCH', 'route' => 'user.update'])}}


 <div class="form-group">
            <label for="fname">Username</label>
{{Form::text('username', $user->username,  array('required'=>'required', 'class'=>'form-control'))}}
</div>
 <div class="form-group">
            <label for="fname">First Name</label>

{{Form::text('fname', $user->fname,  array('required'=>'required', 'class'=>'form-control')) }}
</div>

 <div class="form-group">
            <label for="fname">Lastname</label>

{{Form::text('lname', $user->lname,  array('required'=>'required', 'class'=>'form-control')) }}
</div>

 <div class="form-group">
            <label for="fname">Email</label>
{{Form::email('email', $user->email,  array('required'=>'required', 'class'=>'form-control')) }}
</div>

{{Form::hidden('id', $user->id,  array('required'=>'required')) }}
 <div class="form-group">
            <label for="fname">Password</label>

{{Form::password('password',  array('required'=>'required', 'class'=>'form-control')) }}
</div>
 <div class="form-group">
            <label for="fname">Confirm Password</label>
{{Form::password('confirmpassword',  array('required'=>'required', 'class'=>'form-control'))}}
</div>
<br>
<br>
	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}

	
	<div>
	<br>
	<br>
		<a href="{{ URL::to('/') }}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Back</a>

	</div>

@stop