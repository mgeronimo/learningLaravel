@extends('layouts/login')
@section('content')
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title">Delete Permanently</h4>

      </div>

      <div class="modal-body">
        <p>Are you sure about this ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm">Delete</button>

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



<h1>
User Management
</h1>

<?php $success = Session::get('message') ?>
@if($success)
    <div class="alert-box success">
        <h4>{{ $success }}</h4>
    </div>
@endif



{{ $users= new User; $users = DB::table('users')->get(); }}
<ul class="list-group">
@foreach ($users as $user)
 <li class="list-group-item">
 {{ $user->lname.", ".$user->fname; }}
 <br>
  	<a href="user/edit/{{$user->id}}"><button class="btn btn-primary">Edit</button></a>
<form method="POST" action="user/delete" accept-charset="UTF-8" style="display:inline">
<input type="hidden" name="id" value="{{ $user->id }}">
    <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">

        <i class="glyphicon glyphicon-trash"></i> Delete

    </button>

</form>


</li>
@endforeach
</ul>
@stop