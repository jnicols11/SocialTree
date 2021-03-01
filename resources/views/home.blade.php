<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Social Tree</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
	<h2>Welcome <?php if(Session::get('firstname') != null) { echo Session::get('firstname') . ", "; }?>to your Social Tree!</h2>
	@include('layouts.header')
	<!-- Check if user is logged in -->
	@if(Session::get('firstname') != null)
		<section class="sectionSocial" id="sectionSocial">
			<div class="socialContainer">
				<div class="socialFeed">
					<h2 class="socialTitle">Social Feed</h2>
					<div class="feed">
						<!-- Display list of posts from user connection -->
					</div>
				</div>
				<div class="affinityGroups">
					<h2 class="socialTitle">Your Groups</h2>
					<div class="groupList">
						<!-- Display list of user connected groups -->
						@foreach($model[0] as $group)
						<form action="viewGroupPage" method="post" class="groupForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<label class="groupFormLabel">Group Name: </label>
							<input type="submit" value="{{ $group->getName() }}" class="groupPageBtn">
							<h5 class="ownershipStar">&starf;</h5>
						</form>
						@endforeach
						@foreach($model[1] as $group)
						<form action="viewGroupPage" method="post" class="groupForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="groupID" value="{{ $group->getId() }}">
							<label class="groupFormLabel">Group Name: </label>
							<input type="submit" value="{{ $group->getName() }}" class="groupPageBtn">
						</form>
						@endforeach
					</div>
					<form action="goToAddGroup" method="get" class="addGroupForm">
						<input type="submit" value="Add group" class="addGroupBtn" />
					</form>
				</div>
			</div>
		</section>
	@else
		<!-- Display Landing Page -->
		<section class="sectionAbout" id="sectionAbout">
		</section>
	@endif
	<footer>
		@include('layouts.footer')
	</footer>
</body>
</html>