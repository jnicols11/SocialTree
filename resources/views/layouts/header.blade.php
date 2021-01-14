<!doctype html>
<html lang="en">
<body>
	<div class="navbar">
		<ul class="navbar__list">
			<?php if(Session::get('firstname') != null) { 
				?>
				<li class="navbar__list__item"><a href="./logout">Logout</a></li>
			<?php } else {
				?>
				<li class="navbar__list__item"><a href="./register">Register</a></li>
				<li class="navbar__list__item"><a href="./login">Login</a></li>
			<?php }?>
		</ul>
	</div>
</body>
</html>