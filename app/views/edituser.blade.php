{{
$users= new User;
$users = DB::table('users')->get();
}}

<table >
<tr><th>Name</th><th>&nbsp;</th><th>&nbsp;</th>></tr>
@foreach ($users as $user)
  <tr><td> {{ $user->lname.", ".$user->fname; }}</td><td><a href="edit/{{$user->id}}"><button class="btn btn-primary">Edit</button></a></td><td><a href="delete/{{$user->id}}"><button class="btn btn-primary">Delete</button></a></td></tr>
@endforeach
</table>
