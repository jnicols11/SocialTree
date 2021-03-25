<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\SecurityService;

class HomeController extends Controller
{
	public function goHome() {
        // log function entry
        Log::info('Entering function goHome in class HomeController');

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

            // Log function exit
            Log::info('Leaving function goHome in class HomeController');

			return view('home', compact('model'));
		}

        // Log function exit
        Log::info('Leaving function goHome in class HomeController');
		return view('home');
	}
}
