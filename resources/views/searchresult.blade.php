<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Search Result</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/search.css') }}" rel="stylesheet">
	<script type="text/javascript" src="{{ asset('js/tabs.js') }}"></script>
</head>
<body>
	@include('layouts.header')
		<h2 class="title">Search: {{ $result[0] }}</h2>
		<div class="tab">
			<button class="tablinks" onclick="openSearch(event, 'Jobs')">Jobs</button>
			<button class="tablinks" onclick="openSearch(event, 'Users')">Users</button>
			<button class="tablinks" onclick="openSearch(event, 'Groups')">Groups</button>
		</div>

		<div id="Jobs" class="tabcontent">
			<h2>Jobs related to search: {{ $result[0] }}</h2>
            @if($result[1] == null)
                <h3>Were Sorry, we couldn't find anything for that!</h3>
            @endif
			<div class="jobList">
				@foreach($result[1] as $job)
					<div class="job">
						<label class="jobLabel">{{ $job->getTitle() }}</label>
						<label class="jobLabel">{{ $job->getCompany() }}</label>
						<form action="goToJob" method="post" class="jobForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="jobID" value="{{ $job->getId() }}">
							<input type="submit" class="viewBtn" value="View Job">
						</form>
					</div>
				@endforeach
			</div>
		</div>

		<div id="Users" class="tabcontent">
			<h2>Users related to search: {{ $result[0] }}</h2>
            @if($result[2] == null)
                <h3>Were Sorry, we couldn't find anything for that!</h3>
            @endif
			<div class="userList">
				@foreach($result[2] as $user)
					<div class="user">
                        <label class="userLabel">{{ $user->getFirstname() }}</label>
                        <label class="userLabel">{{ $user->getLastname() }}</label>
                        <label class="userLabel">{{ $user->getEmail() }}</label>
                        <form action="goToUser" method="post" class="userForm">
                            <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                            <input type="hidden" name="email" value="{{ $user->getEmail() }}">
                            <input type="hidden" name="id" value="{{ $user->getId() }}">
                            <input type="submit" class="viewBtn" value="View User">
                        </form>
					</div>
				@endforeach
			</div>
		</div>

		<div id="Groups" class="tabcontent">
			<h2>Groups related to search: {{ $result[0] }}</h2>
            @if($result[3] == null)
                <h3>Were Sorry, we couldn't find anything for that!</h2>
            @endif
			<div class="groupList">
				@foreach($result[3] as $group)
					<div class="group">
                        <label class="groupLabel">{{ $group->getName() }}</label>
                        <form action="viewGroupPage" class="groupForm" method="POST">
                            <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                            <input type="hidden" name="groupID" value="{{ $group->getId() }}">
                            <input type="submit" class="viewBtn" value="View Group">
                        </form>
					</div>
				@endforeach
			</div>
		</div>
	@include('layouts.footer')
</body>
</html>
