<?php

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\PortfolioDAO;

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
	
	public function getWorkHistoryById($id) {
		$dao = new PortfolioDAO($this->connection);
		$work = $dao->getWorkHistoryById($id);
		
		return $work;
	}
	
	public function addWorkExperience($work) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->addWorkExperience($work);
	}
	
	public function deleteWorkExperienceByTitle($title, $id) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->deleteWorkExperienceByTitle($title, $id);
	}

}

