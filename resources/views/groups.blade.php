<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Groups</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/groups.css') }}" rel="stylesheet">
</head>
<body>
	@include('layouts.header')
		<div class="groupListContainer">
			@foreach($model[0] as $group)
				<!-- Check if User owns group -->
				@if($group->getUserID() == Session('id'))
					<div class="groupOwnedContainer">
						<h3 class="groupName">{{ $group->getName() }}</h3>
						<form action="viewGroupPage" method="post" class="groupForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<input type="submit" value="View Page" class="viewGroupBtn">
						</form>
					</div>
				<!-- Check if User is connected to group -->
				@elseif(in_array($group->getId(), $model[1]))
					<div class="groupContainer">
						<h3 class="groupName">{{ $group->getName() }}</h3>
						<form action="leaveGroup" method="post" class="leaveForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<input type="submit" class="leaveGroupBtn" value="Leave">
						</form>
						<form action="viewGroupPage" method="post" class="groupForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<input type="submit" value="View Page" class="viewGroupBtn">
						</form>
					</div>
				@else
					<div class="groupContainer">
						<h3 class="groupName">{{ $group->getName() }}</h3>
						<form action="joinGroup" method="post" class="joinForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<input type="submit" class="joinGroupBtn" value="Join">
						</form>
						<form action="viewGroupPage" method="post" class="groupForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<input type="submit" value="View Page" class="viewGroupBtn">
						</form>
					</div>
				@endif
			@endforeach
		</div>
	@include('layouts.footer')
</body>
</html>