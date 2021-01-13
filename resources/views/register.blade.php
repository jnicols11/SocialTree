<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Register</title>
</head>
<body>
	<form action="doregister" method="POST" class="registerForm">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
		<h2>Register</h2>
		<table class="registerTable">
			<tr>
				<td><label class="registerLabel">First Name</label></td>
				<td><input class="registerInput" type="text" name="firstname" /></td>
				<td><label class="registerLabel">Last Name</label></td>
				<td><input class="registerInput" type="text" name="lastname" /></td>
			</tr>
			<tr>
				<td><label class="registerLabel">Email Address</label></td>
				<td><input class="registerInput" type="text" name="email" /></td>
				<td><label class="registerLabel">Phone Number</label></td>
				<td><input class="registerInput" type="text" name="number" /></td>
			</tr>
			<tr>
				<td><label class="registerLabel">Password</label></td>
				<td ><input class="registerInput" type="password" name="password" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Register" />
				</td>
				<td>
					<a href="./">Go back</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>