<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Manage Users</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/users.css') }}" rel="stylesheet">
</head>
<body>
@include('layouts.header')
	@foreach($users as $user)
		<table class="userTable">
			<tr>
				<td><h4>Firstname: {{ $user->getFirstname() }}</h4></td>
				<td><h4>Lastname: {{ $user->getLastname() }}</h4></td>
			</tr>
			<tr>
				<td><h4>Email Address: {{ $user->getEmail() }}</h4></td>
				<td><h4>Phone Number: {{ $user->getNumber() }}</h4></td>
			</tr>
			<tr>
				<td><h4>Location: {{ $user->getLocation() }}</h4></td>
				<td><h4>Bio: {{ $user->getBio() }}</h4></td>
			</tr>
			<tr>
				<td>
					@if($user->getAdmin() == 1)
						<h4>Admin: Yes</h4>
					@else
						<h4>Admin: No</h4>
					@endif
				</td>
			</tr>
			<tr>
				<td>
					<form class="editForm" action="edituser" method="POST">
						<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
						<input type="hidden" name="email" value="{{ $user->getEmail() }}">
						<input type="submit" value="Edit" />
					</form>
				</td>
				<td>
					<form class="deleteForm" action="deleteuser" method="POST">
						<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
						<input type="hidden" name="email" value="{{ $user->getEmail() }}">
						<input type="submit" value="Delete" />
					</form>
				</td>
			</tr>
		</table>
	@endforeach
</body>
</html>