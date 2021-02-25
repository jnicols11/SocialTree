<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Add Group!</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/addGroup.css') }}" rel="stylesheet">
</head>
<body>
	@include('layouts.header')
		<h2 class="title">Create a Group</h2>
		<form action="createGroup" method="post" class="addGroupForm">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
			<table class="groupTable">
				<tr class="groupTableRow">
					<td>
						<label class="groupLabel">Group Name: </label>
					</td>
					<td>
						<input type="text" class="groupInput" name="name" placeholder="Group Name" />
					</td>
				</tr>
				<tr class="groupTableRow">
					<td>
						<label class="groupLabel">Group Description</label>
					</td>
					<td>
						<textarea class="groupTextarea" rows="6" cols="75" name="description" placeholder="description"></textarea>
					</td>
				</tr>
				<tr class="groupTableRow">
					<td colspan="1">
						<a class="goback" href="./">Go back</a>
					</td>
					<td colspan="2" align="center">
						<input type="submit" value="Create Group!" class="createGroupBtn" />
					</td>
				</tr>
			</table>
		</form>
	@include('layouts.footer')
</body>
</html>