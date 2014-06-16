@extends('layouts.default')

@section('content')

	<h3>Dashboard</h3>
	


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
        <button type="button" class="btn btn-danger" id="confirm">Delete</button>

      </div>

    </div>

  </div>

</div>


<form method="POST" action="user/delete" id="myForm" name="myForm">
<input type="text" name="id" value=<?php echo $id?>>
  <center>
    <button class="iframe btn" style="background-color:transparent" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">

       Delete

    </button>
</center>
</form>
<script type="text/javascript">
    document.getElementById('myForm').submit(); // SUBMIT FORM
</script>





<script type="text/javascript">

  $('#confirmDelete').on('show.bs.modal', function (e) {

      $message = $(e.relatedTarget).attr('data-message');
  $(this).find('.modal-body p').text($message);

  $title = $(e.relatedTarget).attr('data-title');
  $(this).find('.modal-title').text($title);

      var form = $(e.relatedTarget).closest('form');

      $(this).find('.modal-footer #confirm').data('form', form);

  });



  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){

      //$(this).data('form').submit();
      document.getElementById("myForm").submit();

  });

</script>
  @stop