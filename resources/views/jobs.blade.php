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
		<div class="jobList">
			@foreach($jobs as $job)
				<div class="jobContainer">
					<table class="jobListTable">
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
								<textarea class="jobTextArea" rows="10" cols="80" readonly>{{ $job->getDescription() }}</textarea>
							</td>
						</tr>
						<tr>
							<td>
								<form class="editButtonForm" action="#editjobpopup{{ $job->getId() }}" method="get">
									<input type="submit" value="Edit" class="jobButton" />
								</form>
							</td>
							<td>
								<form action="deleteJob" method="post" class="deleteButtonForm">
									<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
									<input type="hidden" name="id" value="{{ $job->getId() }}">
									<input type="submit" value="Delete" />
								</form>
							</td>
						</tr>
					</table>
					<div class="editjobpopup" id="editjobpopup{{ $job->getId() }}">
						<form action="editJob" method="post" class="jobEditForm">
							<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
							<input type="hidden" name="id" value="{{ $job->getId() }}">
							<h2 class="title">Edit Job</h2>
							<table class="jobTable">
								<tr>
									<td>
										<label class="job_label">Title</label>
									</td>
									<td>
										<input class="job_input" type="text" name="title" value="{{ $job->getTitle() }}">
									</td>
								</tr>
								<tr>
									<td>
										<label class="job_label">Company</label>
									</td>
									<td>
										<input class="job_input" type="text" name="company" value="{{ $job->getCompany() }}">
									</td>
								</tr>
								<tr>
									<td>
										<label class="job_label">Description</label>
									</td>
									<td>
										<textarea class="job_textarea" rows="5" cols="40" name="description">{{ $job->getDescription() }}</textarea>
									</td>
								</tr>
								<tr>
									<td colspan="1">
										<a class="goback" href="#">Go back</a>
									</td>
									<td colspan="2" align="center">
										<input type="submit" value="Edit Job!" />
									</td>
								</tr>
							</table>
						</form>	
					</div>
				</div>
			@endforeach
			<form class="addJobButtonForm" action="#jobFormContainer" method="get">
				<input type="submit" value="Add Job" class="addJobButton" />
			</form>
		</div>
		<div class="jobFormContainer" id="jobFormContainer">
			<div class="addjobpopup" id="addjobpopup">
				<form action="addJob" method="post" class="jobAddForm">
					<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
					<h2 class="title">Add Job</h2>
					<table class="jobTable">
						<tr>
							<td>
								<label class="job_label">Title</label>
							</td>
							<td>
								<input class="job_input" type="text" name="title" placeholder="Software Engineer II">
							</td>
						</tr>
						<tr>
							<td>
								<label class="job_label">Company</label>
							</td>
							<td>
								<input class="job_input" type="text" name="company" placeholder="Microsoft">
							</td>
						</tr>
						<tr>
							<td>
								<label class="job_label">Description</label>
							</td>
							<td>
								<textarea class="job_textarea" rows="5" cols="40" name="description" placeholder="Enter Description"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="1">
								<a class="goback" href="#">Go back</a>
							</td>
							<td colspan="2" align="center">
								<input type="submit" value="Add Job!" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>