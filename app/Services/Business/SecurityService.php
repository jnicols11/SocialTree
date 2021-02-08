<?php

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;

class SecurityService {
	private $connection;
	
	public function __construct() {
		$this->connection = $this->getConnection();
	}
	
	private function getConnection() {
		// Establish connection
		$connection = mysqli_connect('localhost', 'root', '', 'socialtree');
		if(!$connection) {
			die("Database connection failed");
		}
		
		return $connection;
	}
	
	
	public function register(UserModel $user) {
		$dao = new SecurityDAO($this->connection);
		return $dao->register($user);
	}
	
	public function login($email, $password) {
		$dao = new SecurityDAO($this->connection);
		return $dao->login($email, $password);
	}
	
	public function getAllUsers() {
		$dao = new SecurityDAO($this->connection);
		return $dao->getAllUsers();
	}
	
	public function getUserByEmail($email) {
		$dao = new SecurityDAO($this->connection);
		return $dao->getUserByEmail($email);
	}
	
	public function updateUserByEmail($user, $email) {
		$dao = new SecurityDAO($this->connection);
		return $dao->updateUserByEmail($user, $email);
	}
	
	public function deleteUserByEmail($email) {
		$dao = new SecurityDAO($this->connection);
		return $dao->deleteUserByEmail($email);
	}
}

