<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Social Tree</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
	<h2>Welcome <?php if(Session::get('firstname') != null) { echo Session::get('firstname') . ", "; }?>to your Social Tree!</h2>
	@include('layouts.header')
	<section class="aboutSection">
	</section>
	<footer>
		@include('layouts.footer')
	</footer>
</body>
</html>