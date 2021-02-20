<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Models\WorkModel;

class PortfolioController extends Controller
{
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
			
			return view('profile', compact('profile'));
		}
		
		return view('workAddFail');
	}
	
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
		
		return view('profile', compact('profile'));
	}
	
	public function deleteWorkExperience(Request $request) {
		// establish variables from request
		$id = session('id');
		$title = $request->input('title');
		
		// Create instance of security service
		$service = new SecurityService();
		
		if($service->deleteWorkExperienceByTitle($title, $id)) {
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
			
			return view('profile', compact('profile'));
		}
		
		return view('deleteWorkFail');
	}
}
