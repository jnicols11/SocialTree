<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class UserController extends Controller
{
	public function register(Request $request) {
		
		// Establish variables from request
		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$number = $request->input('number');
		$password = $request->input('password');
		
		// populate the model
		$user = new UserModel($firstname, $lastname, $email, $number, $password);
		
		// Create instance of security service
		$service = new SecurityService();
		
		// Send User to be registered to service
		if($service->register($user)) {
			// If registered success send view with binded model
			return view('registerSuccess', ['user' => $user]);
		}
		
		// User was not registered
		return view('registerFail');
	}
	
	public function login(Request $request) {
		
		// Establish variables from request
		$email = $request->input('email');
		$password = $request->input('password');
		
		// Create instance of security service
		$service = new SecurityService();
		
		// Send User to be logged in with service
		if($service->login($email, $password)) {
			// If logged in success send view with binded model
			return view('home');
		}
		
		// Login failed
		return view('loginFail');
	}
}
