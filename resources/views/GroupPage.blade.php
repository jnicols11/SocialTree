<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>{{ $models[0]->getName() }} Page</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/group.css') }}" rel="stylesheet">
</head>
<body>
	@include('layouts.header')
		<div class="groupContainer">
			
		</div>
	@include('layouts.footer')
</body>
</html>