@extends('layouts.default')

@section('content')

	<h3>Dashboard</h3>
	


<!-- Message -->
<?php $success = Session::get('message') ?>
@if($success)
    <div class="alert-box success">
        <h4>{{ $success }}</h4>
    </div>
@endif

<!-- Message -->



	<div>
		<br>
    @if(Entrust::can('can_create'))
		<a href="{{ URL::to('user/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Create User</a>
		<br><br>
    @endif
	</div>

	<table id="table_id" class="display">
	    <thead>
	        <tr>
	            <th>Username</th>
	            <th>Name</th>
	            <th>Email</th>
              @if(Entrust::can('can_update') || Entrust::can('can_delete'))
	            <th>Action</th>
              @endif
	        </tr>
	    </thead>

	    <tbody>
<?php $users= new User; $users = DB::table('users')->get(); ?>
@foreach ($users as $user)
<?php
$assigned = Assigned::where('user_id', $user->id)->first();
if ($assigned->role_id==1)
	  {
continue;

    }

     ?>
          <tr>
	            <td> {{ $user->id; }}</td>
	            <td> {{ $user->lname.", ".$user->fname; }}</td>
	            <td> {{ $user->email; }}</td>
              @if(Entrust::can('can_update') ||Entrust::can('can_delete') )
	            <td>
	            	<div class='btn-group'>
						<button class='btn dropdown-toggle btn-primary' data-toggle='dropdown'>Action <span class='caret'></span></button>
						<ul class='dropdown-menu'>
              @if(Entrust::can('can_update'))
							<li><a class='iframe btn' href='user/edit/{{$user->id}}'>Edit</a></li>
              @endif
              @if(Entrust::can('can_delete'))
							<li>

<a href="deluser/{{$user->id}}">Delete</a>
</li>
						@endif
						</ul>
					</div>
        </td>
        @endif
				</tr>
        @endforeach
	    </tbody>
	</table>

  
@stop