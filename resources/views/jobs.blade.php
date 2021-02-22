<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Manage Jobs</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/jobs.css') }}" rel="stylesheet">
</head>
<body>
	@include('layouts.header')
	<div class="jobsContainer">
		@foreach($jobs as $job)
			<div class="jobContainer">
				<table class="jobTable">
					<tr>
						<td>
							<label>Title: </label>
						</td>
						<td>
							<input type="text" value="{{ $job->getTitle() }}" readonly>
						</td>
					</tr>
					<tr>
						<td>
							<label>Company: </label>
						</td>
						<td>
							<input type="text" value="{{ $job->getCompany() }}" readonly>
						</td>
					</tr>
					<tr>
						<td>
							<label>Description: </label>
						</td>
						<td>
							<textarea class="jobTextArea" rows="5" cols="50" readonly>{{ $job->getDescription }}</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<form class="editButtonForm" action="#editjobpopup" method="get">
								<input type="submit" value="Edit" class="jobButton" />
							</form>
						</td>
						<td>
							<form action="deleteJob" method="post" class="deleteButtonForm">
								<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
								<input type="hidden" name="id" value="$job->getId()">
								<input type="submit" value="Delete" />
							</form>
						</td>
					</tr>
				</table>
			</div>
		@endforeach
	</div>
</body>
</html>