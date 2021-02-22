<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Models\WorkModel;
use App\Models\SkillModel;
use App\Models\EduModel;

class PortfolioController extends Controller
{
	public function getProfile() {
		$profile = [];
		$email = session('email');
		$id = session('id');
		
		$service = new SecurityService();
		
		// populate the user
		$user = $service->getUserByEmail($email);
		
		// add user to profile
		array_push($profile, $user);
		
		
		$work_history = $service->getWorkHistoryById($id);
		
		// add work history to profile
		array_push($profile, $work_history);
		
		$education = $service->getEduHistoryById($id);
		
		array_push($profile, $education);
		
		// get skills from service
		$skills = $service->getSkillsById($id);
		
		// add skill to profile
		array_push($profile, $skills);
		
		return view('profile', compact('profile'));
	}
	
	public function addWorkExperience(Request $request) {
		
		// Establish Variables from Request
		$company = $request->input('company');
		$title = $request->input('title');
		$description = $request->input('description');
		$start = $request->input('start');
		$end = $request->input('end');
		$userID = session('id');
		
		// Validate the Form Data
		
		// populate the model
		$work = new WorkModel($company, $title, $description, $start, $end, $userID);
		
		// Create instance of security Service
		$service = new SecurityService();
		
		if($service->addWorkExperience($work)) {
			return redirect('/profile');
		}
		
		return view('workAddFail');
	}
	
	public function addEdu(Request $request) {
		// Establish Variables from Request
		$name = $request->input('name');
		$degree = $request->input('degree');
		$field = $request->input('field');
		$start = $request->input('start');
		$end = $request->input('end');
		$userID = session('id');
		
		// Validate the Form
		
		// populate the model
		$edu = new EduModel($name, $degree, $field, $start, $end, $userID);
		
		// Create instance of Security Service
		$service = new SecurityService();
		
		if($service->addEdu($edu)) {
			return redirect('/profile');
		}
		
		return view('EduAddFail');
	}
	
	public function addSkill(Request $request) {
		// Establish Variables from Request
		$name = $request->input('name');
		$id = session('id');
		
		// validate the Form Data
		
		// populate the model
		$skill = new SkillModel($name, $id);
		
		// create instance of security service
		$service = new SecurityService();
		
		if($service->addSkill($skill)) {
			return redirect('/profile');
		}
		
		return view('SkillAddFail');
	}
	
	public function editWork(Request $request) {
		// Establish variables from Request
		$oldcompany = $request->input('oldcompany');
		$company = $request->input('company');
		$title = $request->input('title');
		$description = $request->input('description');
		$start = $request->input('start');
		$end = $request->input('end');
		$userID = session('id');
		
		// populate WorkModel
		$work = new WorkModel($company, $title, $description, $start, $end, $userID);
		
		// create instance of service
		$service = new SecurityService();
		
		if($service->editWork($work, $oldcompany)) {
			return redirect('/profile');
		}
		
		return view('WorkEditFail');
	}
	
	public function editEdu(Request $request) {
		// Establish variables from request
		$oldname = $request->input('oldname');
		$name = $request->input('name');
		$degree = $request->input('degree');
		$field = $request->input('field');
		$start = $request->input('start');
		$end = $request->input('end');
		$userID = session('id');
		
		// populate EduModel
		$edu = new EduModel($name, $degree, $field, $start, $end, $userID);
		
		// create instance of service
		$service = new SecurityService();
		
		if($service->editEdu($edu, $oldname)) {
			return redirect('/profile');
		}
		
		return view('EditEduFail');
	}
	
	public function editSkill(Request $request) {
		// Establish variables from request
		$oldname = $request->input('oldname');
		$name = $request->input('name');
		$users_id = session('id');
		
		// populate SkillModel
		$skill = new SkillModel($name, $users_id);
		
		// create instance of service
		$service = new SecurityService();
		
		if($service->editSkill($skill, $oldname)) {
			return redirect('/profile');
		}
		
		return view('EditSkillFail');
	}
	
	public function deleteWorkExperience(Request $request) {
		// establish variables from request
		$id = session('id');
		$title = $request->input('title');
		
		// Create instance of security service
		$service = new SecurityService();
		
		if($service->deleteWorkExperienceByTitle($title, $id)) {
			return redirect('/profile');
		}
		
		return view('deleteWorkFail');
	}
	
	public function deleteEdu(Request $request) {
		// establish variables from request
		$id = session('id');
		$name = $request->input('name');
		$degree = $request->input('degree');
		
		// Create instance of security service
		$service = new SecurityService();
		
		if($service->deleteEduByNameAndDegree($name, $degree, $id)) {
			return redirect('/profile');
		}
		
		return view('deleteEduFail');
	}
	
	public function deleteSkill(Request $request) {
		// establish variables from request
		$id = session('id');
		$name = $request->input('name');
		
		// create instance of security service
		$service = new SecurityService();
		
		if($service->deleteSkillByName($name, $id)) {
			return redirect('/profile');
		}
		
		return view('deleteSkillFail');
	}
}
