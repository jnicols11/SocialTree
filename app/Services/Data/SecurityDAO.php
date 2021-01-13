<?php

namespace App\Services\Data;

use App\Models\UserModel;

class SecurityDAO {
	public function register(UserModel $user) {
		
		// Establish connection
		$connection = mysqli_connect('localhost', 'root', '', 'socialtree');
		if(!$connection) {
			die("Database connection failed");
		}
		
		// Create variables
		$firstname = $user->getFirstname();
		$lastname = $user->getLastname();
		$email = $user->getEmail();
		$number = $user->getNumber();
		$password = $user->getPassword();
		
		// prevent SQL injection
		$firstname = mysqli_real_escape_string($connection, $firstname);
		$lastname = mysqli_real_escape_string($connection, $lastname);
		$email = mysqli_real_escape_string($connection, $email);
		$number = mysqli_real_escape_string($connection, $number);
		$password = mysqli_real_escape_string($connection, $password);
		
		// TODO hash and salt password
		
		// generate the query
		$query = "INSERT INTO users(FIRSTNAME,LASTNAME,EMAIL,NUMBER,PASSWORD) ";
		$query .= "VALUES ('$firstname', '$lastname', '$email', '$number', '$password')";
		
		// query the data
		$result = mysqli_query($connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
	
	public function login($email, $password) {
		
		// Establish connection
		$connection = mysqli_connect('localhost', 'root', '', 'socialtree');
		if(!$connection) {
			die("Database connection failed");
		}
		
		// prevent SQL injection
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);
		
		// TODO hash and salt password
		
		// generate the query
		$query = "SELECT * FROM users ";
		$query .= "WHERE EMAIL = '$email' ";
		$query .= "AND PASSWORD = '$password'";
		
		// query table
		$result = mysqli_query($connection, $query);
		$rows = mysqli_num_rows($result);
		if ($rows == 1) {
			// User was found, create user info associative array
			$user_info = mysqli_fetch_assoc($result);
			
			// Create variables
			$firstname = $user_info['FIRSTNAME'];
			$lastname = $user_info['LASTNAME'];
			$email = $user_info['EMAIL'];
			$number = $user_info['NUMBER'];
			$password = $user_info['PASSWORD'];
			
			// Create User Model
			$user = new UserModel($firstname, $lastname, $email, $number, $password);
			
			// Create sessions
			session(['firstname' => $user->getFirstname()]);
			session(['lastname' => $user->getLastname()]);
			session(['email' => $user->getEmail()]);
			session(['number' => $user->getNumber()]);
			return true;
			
		}
		// User was not found
		return false;	
	}
}

