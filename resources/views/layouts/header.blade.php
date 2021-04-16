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
			<li class="navbar__list__item">
                <a href="./">
                    <img src="{{ asset('css/images/tree.jpg') }}" class="logoPic">
                </a>
            </li>
            <?php if(Session::get('admin') == 1) {
				?>
				<li class="navbar__list__item">
                    <form action="users" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="Manage Users">
                    </form>
                </li>
				<li class="navbar__list__item">
                    <form action="jobs" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="Manage Jobs">
                    </form>
                </li>
			<?php }?>
			<?php if(Session::get('firstname') != null) {
				?>
				<li class="navbar__list__item">
                    <form action="profile" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="View your Profile">
                    </form>
                </li>
				<li class="navbar__list__item">
                    <form action="groups" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="Groups">
                    </form>
                </li>
				<li class="navbar__list__item">
                    <form action="logout" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="Logout">
                    </form>
                </li>
			<?php } else {
				?>
				<li class="navbar__list__item">
                    <form action="register" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="Register">
                    </form>
                </li>
				<li class="navbar__list__item">
                    <form action="login" method="GET" class="navbar__form">
                        <input type="submit" class="navbar__btn" value="Login">
                    </form>
                </li>
			<?php }?>
		</ul>
	</div>
</body>
</html>
