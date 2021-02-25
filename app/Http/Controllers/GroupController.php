<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupModel;
use App\Services\Business\SecurityService;

class GroupController extends Controller
{
	public function validateGroup(Request $request) {
		
	}
	
	public function createGroup(Request $request) {
		// Validate the input
		$this->validateGroup($request);
		
		// Establish Variables from Request
		$name = $request->input('name');
		$description = $request->input('description');
		$userID = session('id');
		
		// populate Group Model
		$group = new GroupModel($name, $description, $userID);
		
		// create instance of service
		$service = new SecurityService();
		
		if($service->createGroup($group)) {
			return redirect('/');
		}
		
		return view('CreateGroupFail');
	}
	
	public function viewGroupPage(Request $request) {
		// Establish variables from Request
		$groupID = $request->input('groupID');
		
		// create instance of service
		$service = new SecurityService();
		
		// populate model via service
		$group = $service->getGroupById($groupID);
		
		// get owner of group
		$owner = $service->getUserById($group->getUserID());
		
		// get all users connected to group
		$users = $service->getAllUsersInGroup($group);
		
		// Create model array
		$models = [];
		
		// push models to array
		array_push($models, $group);
		array_push($models, $owner);
		array_push($models, $users);
		
		return view('GroupPage', compact('models'));
	}
	
	public function getAllGroups() {
		// establish instance of service
		$service = new SecurityService();
		
		// populate groups array from service
		$groups = $service->getAllGroups();
		
		// pass groups to view
		return view('groups', compact('groups'));
	}
}
