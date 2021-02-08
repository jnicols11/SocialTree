<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Register</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/register.css') }}" rel="stylesheet">
</head>
<body>
@include('layouts.header')
	<form action="doregister" method="POST" class="registerForm">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
		<h2>Register</h2>
		<table class="registerTable">
			<tr class="registerTable__row">
				<td><label class="registerLabelFirstName">First Name: </label>
				<input class="registerInputName" type="text" name="firstname" placeholder="John" /></td>
				<td><label class="registerLabel">Last Name: </label>
				<input class="registerInputName" type="text" name="lastname" placeholder="Smith" /></td>
			</tr>
			<tr class="registerTable__row">
				<td><label class="registerLabel">Email Address: </label></td>
				<td><input class="registerInput" type="email" name="email" placeholder="someone@example.com" /></td>
			</tr>
			<tr class="registerTable__row">
				<td><label class="registerLabel">Phone Number: </label></td>
				<td><input class="registerInput" type="tel" name="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="012-345-6789" /></td>
			</tr>
			<tr class="registerTable__row">
				<td><label class="registerLabel">Password: </label></td>
				<td ><input class="registerInput" type="password" name="password" placeholder="password" /></td>
			</tr>
			<tr class="registerTable__row">
				<td colspan="1">
					<a class="goback" href="./">Go back</a>
				</td>
				<td colspan="2" align="center">
					<input type="submit" value="Register" />
				</td>
			</tr>
		</table>
	</form>
@include('layouts.footer')
</body>
</html>