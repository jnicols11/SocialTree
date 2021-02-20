<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Your Branch</title>
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
</head>
<body>
@include('layouts.header')
	<h2 class="title">Your Social Branch</h2>
	<form action="doeditprofile" method="post" class="profileForm">
		<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
		<img class="profile_picture" src="{{ asset('css/images/default-profile.png') }}">
		<input class="profile_input_firstname" name="firstname" value="{{ $profile[0]->getFirstname() }}" readonly/>
		<input class="profile_input_lastname" name="lastname" value="{{ $profile[0]->getLastname() }}" readonly/>
		<input class="profile_input_location" name="location" value="{{ $profile[0]->getLocation() }}" readonly/>
		<textarea class="profile__textarea" name="bio" rows="4" cols="50" readonly>{{ $profile[0]->getBio() }}</textarea>
		<a href=#popup class="profile_edit_button">Edit Profile</a>
	</form>
	<br />
	<h2 class="title">Work Experience</h2>
	@foreach($profile[1] as $job)
		<div class="job">
			<div class="job_col">
				<label class="job_label">Company</label>
				<input class="work_input" name="company" value="{{ $job->getCompany() }}" readonly/>
			</div>
			<div class="job_col">
				<label class="job_label">Title</label>
				<input class="work_input" name="title" value="{{ $job->getTitle() }}" readonly />
			</div>
			<div class="job_col">
				<label class="job_label">Description</label>
				<textarea class="work_textbox" name="description" rows="4" cols="50" readonly>{{ $job->getDescription() }}</textarea>
			</div>
			<div class="job_col">
				<label class="job_label">Start Date</label>
				<input type="date" class="work_input" name="start" value="{{ $job->getStart() }}" readonly/>
			</div>
			<div class="job_col">
				<label class="job_label">End Date</label>
				<input type="date" class="work_input" name="end" value="{{ $job->getEnd() }}" readonly/>
			</div>
		</div>
		<div class="workButtonGroup">
			<form action="editWorkExperience" method="post" class="editWorkForm">
				<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
				<input type="hidden" name="title" value="{{ $job->getTitle() }}">
				<input type="submit" value="Edit" class="workButton" />
			</form>
			<form action="deleteWorkExperience" method="post" class="deleteWorkForm">
				<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
				<input type="hidden" name="title" value="{{ $job->getTitle() }}">
				<input type="submit" value="Delete" class="workButton" />
			</form>
		</div>
	@endforeach
	<div class="workAddGroup">
		<a href=#workpopup class="work_add_button">Add Work History</a>
	</div>

@include('layouts.footer')

<div class="popup" id="popup">
		<form action="doeditprofile" method="post" class="editForm">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
			<input type="hidden" name="oldemail" value="{{ $profile[0]->getEmail() }}" />
			<table class="editTable">
				<tr>
					<td>
						<label class="editTable__label">First Name: </label>
						<input class="editTable__input" name="firstname" value="{{ $profile[0]->getFirstname() }}"/>
						<?php echo $errors->first('firstname')?>
					</td>
					<td>
						<label class="editTable__label">Last Name: </label>
						<input class="editTable__input" name="lastname" value="{{ $profile[0]->getLastname() }}"/>
						<?php echo $errors->first('lastname')?>
					</td>
				</tr>
				<tr>
					<td>
						<label class="editTable__label">Email: </label>
						<input class="editTable__input" type="email" name="email" value="{{ $profile[0]->getEmail() }}"/>
						<?php echo $errors->first('email')?>
					</td>
					<td>
						<label class="editTable__label">Phone Number: </label>
						<input class="editTable__input" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="number" value="{{ $profile[0]->getNumber() }}"/>
						<?php echo $errors->first('number')?> 
					</td>
				</tr>
				<tr>
					<td>
						<label class="editTable__label">Location: </label>
						<input class="editTable__input" name="location" value="{{ $profile[0]->getLocation() }}"/> 
					</td>
					<td>
						<label class="editTable__label">Bio: </label>
						<textarea class="editTable__textarea" name="bio" rows="4" cols="50">{{ $profile[0]->getBio() }}</textarea> 
					</td>
				</tr>
				<tr>
					<td>
						<label class="editTable__label">Picture: </label>
						<input class="editTable__input" name="picture" value="{{ $profile[0]->getPicture() }}"/> 
					</td>
					<td>
						<label class="editTable__label">Password </label>
						<input class="editTable__input" type="password" name="password" value="{{ $profile[0]->getPassword() }}"/>
						<?php echo $errors->first('password')?> 
					</td>
				</tr>
				<tr>
					<td colspan="1">
						<a class="goback" href="#">Go back</a>
					</td>
					<td colspan="2" align="center">
						<input type="submit" value="Submit Edit" />
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div class="workpopup" id="workpopup">
			<form action="addWorkExperience" method="post" class="workForm">
				<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
				<table class="workTable">
					<tr>
						<td>
							<label class="workTable__label">Company: </label>
						</td>
						<td>
							<input type="text" class="workTable__input" placeholder="Microsoft" name="company"/>
						</td>
					</tr>
					<tr>
						<td>
							<label class="workTable__label">Title: </label>
						</td>
						<td>
							<input type="text" class="workTable__input" placeholder="Software Engineer II" name="title" />
						</td>
					</tr>
					<tr>
						<td>
							<label class="workTable__label">Description: </label>
						</td>
						<td>
							<textarea class="editTable__textarea" name="description" rows="4" cols="50" placeholder="Enter a description of the job here!"></textarea> 
						</td>
					</tr>
					<tr>
						<td>
							<label class="workTable__lable">Start Date: </label>
						</td>
						<td>
							<input type="date" class="workTable__date" name="start"/>
						</td>
					</tr>
					<tr>
						<td>
							<label class="workTable__label">End Date: </label>
						</td>
						<td>
							<input type="date" class="workTable__date" name="end"/>
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
	
</body>
</html>