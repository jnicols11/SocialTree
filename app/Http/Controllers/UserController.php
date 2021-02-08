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
		$user = new UserModel($firstname, $lastname, $email, $number, $password);		// Create instance of security service
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
	
	public function getAllUsers() {
		$service = new SecurityService();
		
		$users = $service->getAllUsers();
		return view('users', compact('users'));
	}
	
	public function getUser(Request $request) {
		$email = $request->input('email');
		$service = new SecurityService();
		
		// populate the user
		$user = $service->getUserByEmail($email);
		
		return view('edituser', ['user' => $user]);
	}
	
	public function getProfile() {
		$email = session('email');
		
		$service = new SecurityService();
		
		// populate the user
		$user = $service->getUserByEmail($email);
		
		return view('profile', ['user' => $user]);
	}
	
	public function editUser(Request $request) {
		
		// Establish variables from request
		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$number = $request->input('number');
		$password = $request->input('password');
		$location = $request->input('location');
		$bio = $request->input('bio');
		$picture = $request->input('picture');
		$admin = $request->input('admin');
		
		$oldemail = $request->input('oldemail');
		
		// populate user model
		$user = new UserModel($firstname, $lastname, $email, $number, $password);
		$user->setLocation($location);
		$user->setBio($bio);
		$user->setPicture($picture);
		$user->setAdmin($admin);
		
		
		// send user to service
		$service = new SecurityService();
		
		// return view if success
		if($service->updateUserByEmail($user, $oldemail)) {
			$users = $service->getAllUsers();
			return view('users', compact('users'));
		}
		
		return view('updatefail');
	}
	
	public function editProfile(Request $request) {
		
		// Establish variables from request
		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$number = $request->input('number');
		$password = $request->input('password');
		$location = $request->input('location');
		$bio = $request->input('bio');
		$picture = $request->input('picture');
		$admin = session('admin');
		
		$oldemail = $request->input('oldemail');
		
		// populate user model
		$user = new UserModel($firstname, $lastname, $email, $number, $password);
		$user->setLocation($location);
		$user->setBio($bio);
		$user->setPicture($picture);
		$user->setAdmin($admin);
		
		
		// send user to service
		$service = new SecurityService();
		
		// return view if success
		if($service->updateUserByEmail($user, $oldemail)) {
			
			return view('profile', ['user' => $user]);
		}
		
		return view('updatefail');
	}
	
	public function deleteUser(Request $request) {
		$email = $request->input('email');
		$service = new SecurityService();
		
		// delete the user
		if($service->deleteUserByEmail($email)) {
			$service = new SecurityService();
			
			$users = $service->getAllUsers();
			return view('users', compact('users'));
		}
		
		$users = [];
		$service = new SecurityService();
		
		$users = $service->getAllUsers();
		return view('users', compact('users'), ['message' => "Delete Failed"]);
	}
	
	public function logout() {
		// clear sessions
		session_start();
		session(['firstname' => null]);
		session(['lastname' => null]);
		session(['email' => null]);
		session(['number' => null]);
		session(['admin' => null]);
		
		return view('home');
	}
}
