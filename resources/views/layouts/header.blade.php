<!doctype html>
<html lang="en">
<head>
	<link href="{{ asset('css/header.css') }}" rel="stylesheet">
</head>
<body>
	<div class="searchContainer">
		<form action="doSearch" method="post" class="searchForm">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
			<input type="text" name="searchValue" placeholder="Search...">
			<input type="submit" class="searchBtn" value="Search">
		</form>
	</div>
	<div class="navbar">
		<ul class="navbar__list">
			<li class="navbar__list__item"><a href="./">Logo</a></li>
			<?php if(Session::get('firstname') != null) { 
				?>
				<li class="navbar__list__item"><a href="./profile">View your Profile</a></li>
				<li class="navbar__list__item"><a href="./groups">Groups</a></li>
				<li class="navbar__list__item"><a href="./logout">Logout</a></li>
			<?php } else {
				?>
				<li class="navbar__list__item"><a href="./register">Register</a></li>
				<li class="navbar__list__item"><a href="./login">Login</a></li>
			<?php }?>
			<?php if(Session::get('admin') == 1) {
				?>
				<li class="navbar__list__item"><a href="./users">Manage all users</a></li>
				<li class="navbar__list__item"><a href="./jobs">Manage Jobs</a></li>
			<?php }?>
		</ul>
	</div>
</body>
</html>