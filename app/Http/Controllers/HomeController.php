<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;

class HomeController extends Controller
{
	public function goHome() {
		// Set all models for logged in landing page
		if(session('id') != null) {
			$model = [];
			
			// Create instance of security service
			$service = new SecurityService();
			
			// Get all groups the user owns
			$groups = $service->getAllOwnedGroups();
			
			// add groups to model
			array_push($model, $groups);
			
			// Get all user connected Groups
			$userGroupIds = $service->getAllUserConnectedGroups();
			$userGroups = [];
			foreach($userGroupIds as $groupID) {
				$group = $service->getGroupById($groupID);
				array_push($userGroups, $group);
			}
			
			// add user groups to model
			array_push($model, $userGroups);
			
			return view('home', compact('model'));
		}
		
		return view('home');
	}
}
