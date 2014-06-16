@extends('layouts.login')

@section('content')
{{View::make(Config::get('confide::signup_form'));}}

<div>
		<br>
		<a href="{{ URL::to('/') }}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Back</a>
		<br><br>
	</div>
@stop