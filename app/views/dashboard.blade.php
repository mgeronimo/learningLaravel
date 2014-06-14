@extends('layouts.default')

@section('content')

	<h3>Dashboard</h3>
	






<!--
	Delete confirmation
-->



<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title">Delete Parmanently</h4>

      </div>

      <div class="modal-body">
        <p>Are you sure about this ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>

      </div>

    </div>

  </div>

</div>
<script type="text/javascript">

  $('#confirmDelete').on('show.bs.modal', function (e) {

      $message = $(e.relatedTarget).attr('data-message');
  $(this).find('.modal-body p').text($message);

  $title = $(e.relatedTarget).attr('data-title');
  $(this).find('.modal-title').text($title);

      var form = $(e.relatedTarget).closest('form');

      $(this).find('.modal-footer #confirm').data('form', form);

  });

  <!-- Form confirm (yes/ok) handler, submits form -->

  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){

      $(this).data('form').submit();

  });

</script>


<!-- end of delete confirmation-->


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

	        <tr>
	            <td> {{ $user->username; }}</td>
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
<form method="POST" action="user/delete" >
<input type="hidden" name="id" value="{{ $user->id }}">
  <center>
 <form method="POST" action="user/delete" accept-charset="UTF-8" style="display:inline">
<input type="hidden" name="id" value="{{ $user->id }}">
    <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">

        <i class="glyphicon glyphicon-trash"></i> Delete

    </button>

</form>

</center>
</form></li>
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