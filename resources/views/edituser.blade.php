<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Edit User</title>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
	@include('layouts.header')
	
	<h2 class="title">Edit User: {{ $user->getFirstname() }} {{ $user->getLastname() }}</h2>
	<form action="doedit" method="post" class="editForm">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
		<input type="hidden" name="password" value="{{ $user->getPassword() }}" />
		<input type="hidden" name="oldemail" value="{{ $user->getEmail() }}" />
		<table class="editTable">
			<tr>
				<td>
					<label class="editTable__label">First Name: </label>
					<input class="editTable__input" name="firstname" value="{{ $user->getFirstname() }}"/>
					<?php echo $errors->first('firstname')?>
				</td>
				<td>
					<label class="editTable__label">Last Name: </label>
					<input class="editTable__input" name="lastname" value="{{ $user->getLastname() }}"/>
					<?php echo $errors->first('lastname')?>
				</td>
			</tr>
			<tr>
				<td>
					<label class="editTable__label">Email: </label>
					<input class="editTable__input" type="email" name="email" value="{{ $user->getEmail() }}"/> 
					<?php echo $errors->first('email')?>
				</td>
				<td>
					<label class="editTable__label">Phone Number: </label>
					<input class="editTable__input" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="number" value="{{ $user->getNumber() }}"/> 
					<?php echo $errors->first('number')?>
				</td>
			</tr>
			<tr>
				<td>
					<label class="editTable__label">Location: </label>
					<input class="editTable__input" name="location" value="{{ $user->getLocation() }}"/>
				</td>
				<td>
					<label class="editTable__label">Bio: </label>
					<textarea class="editTable__textarea" name="bio" rows="4" cols="50">{{ $user->getBio() }}</textarea> 
				</td>
			</tr>
			<tr>
				<td>
					<label class="editTable__label">Picture: </label>
					<input class="editTable__input" name="picture" value="{{ $user->getPicture() }}"/> 
				</td>
				<td>
					<label class="editTable__label">Admin: </label>
					<input class="editTable__input" name="admin" value="{{ $user->getAdmin() }}"/> 
				</td>
			</tr>
			<tr>
				<td colspan="1">
					<a class="goback" href="./users">Go back</a>
				</td>
				<td colspan="2" align="center">
					<input type="submit" value="Submit Edit" />
				</td>
			</tr>
		</table>
	</form>
	
	@include('layouts.footer')
</body>
</html>