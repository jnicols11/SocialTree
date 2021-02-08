<?php

namespace App\Services\Data;

use App\Models\UserModel;

class SecurityDAO {
	private $connection;
	
	public function __construct($connection) {
		$this->connection = $connection;
	}
	
	public function register(UserModel $user) {
		
		// Create variables
		$firstname = $user->getFirstname();
		$lastname = $user->getLastname();
		$email = $user->getEmail();
		$number = $user->getNumber();
		$password = $user->getPassword();
		
		// prevent SQL injection
		$firstname = mysqli_real_escape_string($this->connection, $firstname);
		$lastname = mysqli_real_escape_string($this->connection, $lastname);
		$email = mysqli_real_escape_string($this->connection, $email);
		$number = mysqli_real_escape_string($this->connection, $number);
		$password = mysqli_real_escape_string($this->connection, $password);
		
		// TODO hash and salt password
		
		// generate the query
		$query = "INSERT INTO users(FIRSTNAME,LASTNAME,EMAIL,NUMBER,PASSWORD) ";
		$query .= "VALUES ('$firstname', '$lastname', '$email', '$number', '$password')";
		
		// query the data
		$result = mysqli_query($this->connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
	
	public function login($email, $password) {
			
		// prevent SQL injection
		$email = mysqli_real_escape_string($this->connection, $email);
		$password = mysqli_real_escape_string($this->connection, $password);
		
		// TODO hash and salt password
		
		// generate the query
		$query = "SELECT * FROM users ";
		$query .= "WHERE EMAIL = '$email' ";
		$query .= "AND PASSWORD = '$password'";
		
		// query table
		$result = mysqli_query($this->connection, $query);
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
			$admin = $user_info['ADMIN'];
			
			// Create User Model
			$user = new UserModel($firstname, $lastname, $email, $number, $password);
			$user->setAdmin($admin);
			
			// Create sessions
			session_start();
			session(['firstname' => $user->getFirstname()]);
			session(['lastname' => $user->getLastname()]);
			session(['email' => $user->getEmail()]);
			session(['number' => $user->getNumber()]);
			session(['admin' => $user->getAdmin()]);
			return true;
			
		}
		// User was not found
		return false;	
	}
	
	public function getAllUsers() {
		
		// generate the query
		$query = "SELECT * FROM users";
		
		// query table
		$result = mysqli_query($this->connection, $query);
		$users = [];
		while($row = mysqli_fetch_assoc($result)) {
			$user = new UserModel($row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['NUMBER'], $row['PASSWORD']);
			$user->setAdmin($row['ADMIN']);
			$user->setBio($row['BIO']);
			$user->setLocation($row['LOCATION']);
			array_push($users, $user);
		}
		
		return $users;
	}
	
	public function getUserByEmail($email) {
		
		// prevent sql injection
		$email = mysqli_real_escape_string($this->connection, $email);
		
		// generate the query
		$query = "SELECT * FROM users ";
		$query .= "WHERE EMAIL = '$email'";
		
		// Query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
			// fetch the array
			$user_info = mysqli_fetch_assoc($result);
			
			// create variables
			$firstname = $user_info['FIRSTNAME'];
			$lastname = $user_info['LASTNAME'];
			$email = $user_info['EMAIL'];
			$number = $user_info['NUMBER'];
			$password = $user_info['PASSWORD'];
			$location = $user_info['LOCATION'];
			$bio = $user_info['BIO'];
			$picture = $user_info['PICTURE'];
			$admin = $user_info['ADMIN'];
			
			// populate and return model
			$user = new UserModel($firstname, $lastname, $email, $number, $password);
			$user->setLocation($location);
			$user->setBio($bio);
			$user->setPicture($picture);
			$user->setAdmin($admin);
			
			return $user;
		}
	}
	
	public function updateUserByEmail($user, $email) {
		
		// Set variables
		$firstname = $user->getFirstname();
		$lastname = $user->getLastname();
		$newemail = $user->getEmail();
		$number = $user->getNumber();
		$password = $user->getPassword();
		$location = $user->getLocation();
		$bio = $user->getBio();
		$picture = $user->getPicture();
		$admin = $user->getAdmin();
		
		// prevent SQL injection
		$firstname = mysqli_real_escape_string($this->connection, $firstname);
		$lastname = mysqli_real_escape_string($this->connection, $lastname);
		$newemail = mysqli_real_escape_string($this->connection, $newemail);
		$number = mysqli_real_escape_string($this->connection, $number);
		$password = mysqli_real_escape_string($this->connection, $password);
		$location = mysqli_real_escape_string($this->connection, $location);
		$bio = mysqli_real_escape_string($this->connection, $bio);
		$picture = mysqli_real_escape_string($this->connection, $picture);
		$admin = mysqli_real_escape_string($this->connection, $admin);
		
		// Generate the query
		$query = "UPDATE users SET ";
		$query .= "FIRSTNAME = '$firstname', LASTNAME = '$lastname', EMAIL = '$newemail', NUMBER = '$number', ";
		$query .= "PASSWORD = '$password', LOCATION = '$location', BIO = '$bio', PICTURE = '$picture', ADMIN = '$admin' ";
		$query .= "WHERE EMAIL = '$email'";
		
		// Query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
			// user was updated
			return true;
		}
		
		return false;
	}
	
	public function deleteUserByEmail($email) {
		// prevent SQL injection
		$email = mysqli_real_escape_string($this->connection, $email);
		
		// generate the query
		$query = "DELETE FROM users ";
		$query .= "WHERE EMAIL = '$email'";
		
		// Query the table
		$result = mysqli_query($this->connection, $query);
		if ($result) {
			return true;
		}
		
		return false;
	}
}