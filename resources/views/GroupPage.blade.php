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
			<div class="groupIntro">
				<h2 class="groupTitle">{{ $models[0]->getName() }} Group</h2>
				<h4 class="groupTitle2">Owner: {{ $models[1]->getFirstname() . " " . $models[1]->getLastname() }}</h4>
			</div>
			<div class="groupDescContainer">
				<p class="groupDesc">{{ $models[0]->getDescription() }}</p>
			</div>
			<div class="groupUsersContainer">
				<h2 class="groupTitle">Users in Group</h2>
				@foreach($models[2] as $user)
					<div class="userContainer">
						<label class="userLabel">{{ $user->getFirstname() . " " . $user->getLastname() }}</label>
					</div>
				@endforeach
			</div>
		</div>
	@include('layouts.footer')
</body>
</html>