@extends('layouts.default')

@section('content')

	<div>
		<br>
		<a href="{{ URL::to('user/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Create User</a>
		<br><br>
	</div>

	<table id="table_id" class="display">
	    <thead>
	        <tr>
	            <th>Username</th>
	            <th>First Name</th>
	            <th>Last Name</th>
	            <th>Email</th>
	            <th>Action</th>

	        </tr>
	    </thead>
	    <tbody>
	        <tr>
	            <td>a</td>
	            <td>b</td>
	            <td>c</td>
	            <td>d</td>
	            <td>
	            	<div class='btn-group'>
						<button class='btn dropdown-toggle btn-primary' data-toggle='dropdown'>Action <span class='caret'></span></button>
						<ul class='dropdown-menu'>
							<li><a class='iframe btn' href='#'>Edit</a></li>
							<li><p></p></li>
							<li><a class='iframe btn' href='#'>Delete</a></li>
							<li><p></p></li>
						</ul>
					</div>
				</td>
	        </tr>
	        <tr>
	            <td>e</td>
	            <td>f</td>
	            <td>g</td>
	            <td>h</td>
	            <td>
	            	<div class='btn-group'>
						<button class='btn dropdown-toggle btn-primary' data-toggle='dropdown'>Action <span class='caret'></span></button>
						<ul class='dropdown-menu'>
							<li><a class='iframe btn' href='#'>Edit</a></li>
							<li><a class='iframe btn' href='#'>Delete</a></li>
						</ul>
					</div>
				</td>
	        </tr>
	    </tbody>
	</table>
@stop