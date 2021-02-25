<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;

class HomeController extends Controller
{
	public function goHome() {
		// Set all models for logged in landing page
		if(session('id') != null) {
			// Create instance of security service
			$service = new SecurityService();
			
			// Get all groups the user owns
			$groups = $service->getAllOwnedGroups();
			
			return view('home', compact('groups'));
		}
		
		return view('home');
	}
}
