<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class UserController extends Controller
{
	private function validateUser(Request $request) {
        // Log function entry
        Log::info('Entering function validateUser in class UserController');

		// Setup Data Validation Rules for Users
		$rules = ['firstname' => 'Required | Between:2,30 | Alpha', 'lastname' => 'Required | Between:2,50 | Alpha', 'email' => 'Required | Between:5,100', 'number' => 'Required', 'password' => 'Required | Between:7,100'];

        // Log function exit
        Log::info('Exiting function validateUser in class UserController');

		// Validate the Data
		$this->validate($request, $rules);
	}

	public function register(Request $request) {
        // Log function entry
        Log::info('Entering function register in class UserController');

		// Establish variables from request
		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$number = $request->input('number');
		$password = $request->input('password');

		// Validate the Form Data
		$this->validateUser($request);

		// populate the model
		$user = new UserModel($firstname, $lastname, $email, $number, $password);

		// Create instance of security service
		$service = new SecurityService();

		// Send User to be registered to service
		if($service->register($user)) {
			// If registered success send view with binded model

            // Log function Exit
            Log::info('Exiting function register in class UserController');

			return redirect('/login');
		}

        // Log error
        Log::error('Failed to regiseter User. Exiting function register in class UserController');

		// User was not registered
		return view('registerFail');
	}

	public function login(Request $request) {
        // Log function entry
        Log::info('Entering function login in class UserController');

		// Establish variables from request
		$email = $request->input('email');
		$password = $request->input('password');

		// Create instance of security service
		$service = new SecurityService();

		// Send User to be logged in with service
		if($service->login($email, $password)) {
			// If logged in success send view with binded model

            // Log function Exit
            Log::info('Exiting function login in class UserController');

			return redirect('/');
		}

        // Log error
        Log::error('Failed to login User. Exiting function login in class UserController');

		// Login failed
		return view('loginFail');
	}

	public function getAllUsers() {
        // Log function entry
        Log::info('Entering function getAllUsers in class UserController');

		$service = new SecurityService();

		$users = $service->getAllUsers();

         // Log function Exit
         Log::info('Exiting function getAllUsers in class UserController');

		return view('users', compact('users'));
	}

	public function getUser(Request $request) {
        // Log function entry
        Log::info('Entering function getUser in class UserController');

		$email = $request->input('email');

		$service = new SecurityService();

		// populate the user
		$user = $service->getUserByEmail($email);

        // Log function Exit
        Log::info('Exiting function getUser in class UserController');

		return view('edituser', ['user' => $user]);
	}

	public function getProfile() {
        // Log function entry
        Log::info('Entering function getProfile in class UserController');

		$email = session('email');

		$service = new SecurityService();

		// populate the user
		$user = $service->getUserByEmail($email);

        // Log function Exit
        Log::info('Exiting function getProfile in class UserController');

		return view('profile', ['user' => $user]);
	}

	public function editUser(Request $request) {
        // Log function entry
        Log::info('Entering function editUser in class UserController');

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

		// Validate the Form Data
		$this->validateUser($request);

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

            // Log function Exit
            Log::info('Exiting function editUser in class UserController');

			return view('users', compact('users'));
		}

        // Log Error
        Log::error('Failed to update User! Exiting function editUser in class UserController');

		return view('updatefail');
	}

	public function editProfile(Request $request) {
        // Log function entry
        Log::info('Entering function editProfile in class UserController');

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

		// Validate the Form Data
		$this->validateUser($request);

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
            // Log function Exit
            Log::info('Exiting function editProfile in class UserController');

			return redirect('/profile');
		}

        // Log Error
        Log::error('Failed to update User Profile! Exiting function editProfile in class UserController');

		return view('updatefail');
	}

	public function deleteUser(Request $request) {
         // Log function entry
         Log::info('Entering function deleteUser in class UserController');

		$email = $request->input('email');
		$service = new SecurityService();

		// delete the user
		if($service->deleteUserByEmail($email)) {
			$service = new SecurityService();

			$users = $service->getAllUsers();

            // Log function Exit
            Log::info('Exiting function deleteUser in class UserController');

			return view('users', compact('users'));
		}

		$users = [];
		$service = new SecurityService();

		$users = $service->getAllUsers();

        // Log Error
        Log::error('Failed to delete user! Exiting function deleteUser in class UserController');

		return view('users', compact('users'), ['message' => "Delete Failed"]);
	}

	public function logout() {
         // Log function entry
         Log::info('Entering function logout in class UserController');

		// clear sessions
		session_start();
		session(['id' => null]);
		session(['firstname' => null]);
		session(['lastname' => null]);
		session(['email' => null]);
		session(['number' => null]);
		session(['admin' => null]);

        // Log function Exit
        Log::info('Exiting function logout in class UserController');

		return view('home');
	}
	
	public function getUserForApi($id) {
		// Log function entry
		Log::info('Entering function getUserForApi in class UserController');
		
		// Create instance of service
		$service = new SecurityService();
		
		// Get user from service
		$user = $service->getUserById($id);
		
		// Serialize the user to Json
		$json = json_encode($user);
		
		// Log the function exit
		Log::info('Exiting function getUserForApi in class UserController');
		
		return $json;
	}
}
