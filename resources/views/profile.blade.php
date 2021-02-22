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
	<hr class="profileSplit">
	<h2 class="title" id="worktitle">Work Experience</h2>
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
			<form action="#workeditpopup{{ $job->getCompany() }}" method="get" class="editWorkForm">
				<input type="submit" value="Edit" class="workButton" />
			</form>
			<form action="deleteWorkExperience" method="post" class="deleteWorkForm">
				<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
				<input type="hidden" name="title" value="{{ $job->getTitle() }}">
				<input type="submit" value="Delete" class="workButton" />
			</form>
		</div>
		<div class="workeditpopup" id="workeditpopup{{ $job->getCompany() }}">
			<form action="editWork" method="post" class="editWorkEntry">
				<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
				<input type="hidden" name="oldcompany" value="{{ $job->getCompany() }}">
				<table class="editWorkTable">
					<tr>
						<td>
							<label>Company: </label>
						</td>
						<td>
							<input type="text" value="{{ $job->getCompany() }}" name="company">
						</td>
					</tr>
					<tr>
						<td>
							<label>Title: </label>
						</td>
						<td>
							<input type="text" value="{{ $job->getTitle() }}" name="title">
						</td>
					</tr>
					<tr>
						<td>
							<label>Description: </label>
						</td>
						<td>
							<textarea class="work_textbox" name="description" rows="4" cols="50">{{ $job->getDescription() }}</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<label>Start Date</label>
						</td>
						<td>
							<input type="date" class="work_input" name="start" value="{{ $job->getStart() }}" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Start Date</label>
						</td>
						<td>
							<input type="date" class="work_input" name="end" value="{{ $job->getEnd() }}" />
						</td>
					</tr>
					<tr>
						<td colspan="1">
							<a class="goback" href="#worktitle">Go back</a>
						</td>
						<td colspan="2" align="center">
							<input type="submit" value="Edit Job!" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	@endforeach
	<div class="workAddGroup">
		<a href=#workpopup class="work_add_button">Add Work History</a>
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
							<a class="goback" href="#worktitle">Go back</a>
						</td>
						<td colspan="2" align="center">
							<input type="submit" value="Add Job!" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	<br />
	<hr class="profileSplit">
	<div class="eduSection" id="eduSection">
		<h2 class="edutitle">Education History</h2>
		@foreach($profile[2] as $edu)
			<div class="edu">
				<div class="edu_row">
					<label class="edu_label">Institution</label>
					<input class="edu_input" name="name" value="{{ $edu->getName() }}" readonly />
				</div>
				<div class="edu_row">
					<label class="edu_label">Degree</label>
					<input class="edu_input" name="degree" value="{{ $edu->getDegree() }}" readonly />
				</div>
				<div class="edu_row">
					<label class="edu_label">Field</label>
					<input class="edu_input" name="field" value="{{ $edu->getField() }}" readonly />
				</div>
				<div class="edu_row">
					<label class="edu_label">Start Date</label>
					<input type="date" class="edu_input" name="start" value="{{ $edu->getStart() }}" readonly/>
				</div>
				<div class="edu_row">
					<label class="job_label">End Date</label>
					<input type="date" class="edu_input" name="end" value="{{ $edu->getEnd() }}" readonly/>
				</div>
			</div>
			<div class="eduButtonGroup">
				<form action="#edueditpopout{{ $edu->getName() }}" method="get" class="editEduForm">
					<input type="submit" value="Edit" class="eduButton" />
				</form>
				<form action="deleteEdu" method="post" class="deleteEduForm">
					<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
					<input type="hidden" name="name" value="{{ $edu->getName() }}">
					<input type="hidden" name="degree" value="{{ $edu->getDegree() }}">
					<input type="submit" value="Delete" class="eduButton" />
				</form>
			</div>
			<div class="edueditpopout" id="edueditpopout{{ $edu->getName() }}">
				<form action="editEdu" method="post" class="eduEditEntry">
					<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
					<input type="hidden" name="oldname" value="{{ $edu->getName() }}">
					<table class="editEduTable">
						<tr>
							<td>
								<label>Institution: </label>
							</td>
							<td>
								<input type="text" class="edu_input" name="name" value="{{ $edu->getName() }}">
							</td>
						</tr>
						<tr>
							<td>
								<label>Degree: </label>
							</td>
							<td>
								<input type="text" class="edu_input" name="degree" value="{{ $edu->getDegree() }}">
							</td>
						</tr>
						<tr>
							<td>
								<label>Field: </label>
							</td>
							<td>
								<input type="text" class="edu_input" name="field" value="{{ $edu->getField() }}">
							</td>
						</tr>
						<tr>
						<td>
							<label>Start Date</label>
						</td>
						<td>
							<input type="date" class="edu_input" name="start" value="{{ $edu->getStart() }}" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Start Date</label>
						</td>
						<td>
							<input type="date" class="edu_input" name="end" value="{{ $edu->getEnd() }}" />
						</td>
					</tr>
					<tr>
						<td colspan="1">
							<a class="goback" href="#eduSection">Go back</a>
						</td>
						<td colspan="2" align="center">
							<input type="submit" value="Edit Education!" />
						</td>
					</tr>
					</table>
				</form>
			</div>
		@endforeach
		<div class="eduAddGroup">
			<a href=#edupopup class="edu_add_button">Add Education History</a>
		</div>
	</div>
	<div class="edupopup" id="edupopup">
		<form action="addEdu" method="post" class="addEduForm">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
			<table class="eduTable">
				<tr>
					<td>
						<label class="eduTable_label">Institution</label>
					</td>
					<td>
						<input type="text" class="eduTable_input" placeholder="Grand Canyon University" name="name"> 
					</td>
				</tr>
				<tr>
					<td>
						<label class="eduTable_label">Degree</label>
					</td>
					<td>
						<input type="text" class="eduTable_input" placeholder="Masters" name="degree">
					</td>
				</tr>
				<tr>
					<td>
						<label class="edutable_label">Field</label>
					</td>
					<td>
						<input type="text" class="eduTable_input" placeholder="Engineering" name="field">
					</td>
				</tr>
				<tr>
					<td>
						<label class="eduTable__lable">Start Date: </label>
					</td>
					<td>
						<input type="date" class="eduTable__date" name="start"/>
					</td>
				</tr>
				<tr>
					<td>
						<label class="eduTable__label">End Date: </label>
					</td>
					<td>
						<input type="date" class="eduTable__date" name="end"/>
					</td>
				</tr>
				<tr>
					<td colspan="1">
						<a class="goback" href="#eduSection">Go back</a>
					</td>
					<td colspan="2" align="center">
						<input type="submit" value="Add Education!" />
					</td>
				</tr>
			</table>
		</form>
	</div>
	<br />
	<hr class="profileSplit">
	<div class="skillSection" id="skillSection">
		<h2 class="edutitle">Special Skills</h2>
		@foreach($profile[3] as $skill)
			<div class="skillContainer">
				<label class="skill_label">Skill Name </label>
				<input class="skill_input" name="name" value="{{ $skill->getName() }}" readonly/>
				<form action="#skilleditpopup{{ $skill->getName() }}" method="get" class="editSkillForm">
					<input type="submit" value="Edit" class="skillButton">
				</form>
				<form action="deleteSkill" method="post" class="deleteSkillForm">
					<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
					<input type="hidden" name="name" value="{{ $skill->getName() }}">
					<input type="submit" value="Delete" class="skillButton">
				</form>
			</div>
			<div class="skilleditpopup" id="skilleditpopup{{ $skill->getName() }}">
				<form action="editSkill" method="post" class="editSkillEntry">
					<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
					<input type="hidden" name="oldname" value="{{ $skill->getName() }}">
					<label class="skill_label">Skill Name </label>
					<input class="skill_input" name="name" value="{{ $skill->getName() }}">
					<input type="submit" value="Edit Skill!">
					<a class="goback" href="#skillSection">Go back</a>
				</form>
			</div>
		@endforeach
		<div class="skillAddGroup">
			<a href="#skillpopup" class="skill_add_button">Add Skills</a>
		</div>
	</div>
	<div class="skillpopup" id="skillpopup">
		<form action="addSkill" method="post" class="addSkillForm">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
			<table class="skillTable">
				<tr>
					<td>
						<label class="skillTable_label">Name: </label>
					</td>
					<td>
						<input type="text" class="skillTable_input" name="name" placeholder="Microsoft Office">
					</td>
				</tr>
				<tr>
					<td colspan="1">
						<a class="goback" href="#skillSection">Go back</a>
					</td>
					<td colspan="2" align="center">
						<input type="submit" value="Add Skill!" />
					</td>
				</tr>
			</table>
		</form>
	</div>

@include('layouts.footer')
</body>
</html>