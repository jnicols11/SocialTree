<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Login</title>
</head>
<body>
	<form action="dologin" method="POST" class="loginForm">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
		<h2>Login</h2>
		<table class="loginTable">
			<tr>
				<td><label class="loginLabel">Email</label></td>
				<td><input class="loginInput" type="text" name="email" /></td>
			</tr>
			<tr>
				<td><label class="loginLabel">Password</label></td>
				<td><input class="loginInput" type="password" name="password" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input class="loginSubmit" type="submit" value="Login" />
				</td>
				<td>
					<a href="./">Go back</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>