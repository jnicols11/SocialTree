<?php

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\PortfolioDAO;
use App\Services\Data\JobDAO;
use App\Services\Data\GroupDAO;

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
	
	// User Functions
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
	
	public function getUserById($userID) {
		$dao = new SecurityDAO($this->connection);
		return $dao->getUserById($userID);
	}
	
	// Portfolio Functions
	public function getWorkHistoryById($id) {
		$dao = new PortfolioDAO($this->connection);
		$work = $dao->getWorkHistoryById($id);
		
		return $work;
	}
	
	public function getEduHistoryById($id) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->getEduHistoryById($id);
	}
	
	public function getSkillsById($id) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->getSkillsById($id);
	}
	
	public function addWorkExperience($work) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->addWorkExperience($work);
	}
	
	public function addEdu($edu) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->addEdu($edu);
	}
	
	public function addSkill($skill) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->addSkill($skill);
	}
	
	public function editWork($work, $oldcompany) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->editWork($work, $oldcompany);
	}
	
	public function editEdu($edu, $oldname) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->editEdu($edu, $oldname);
	}
	
	public function editSkill($skill, $oldname) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->editSkill($skill, $oldname);
	}
	
	public function deleteWorkExperienceByTitle($title, $id) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->deleteWorkExperienceByTitle($title, $id);
	}
	
	public function deleteEduByNameAndDegree($name, $degree, $id) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->deleteEduByNameAndDegree($name, $degree, $id); 
	}
	
	public function deleteSkillByName($name, $id) {
		$dao = new PortfolioDAO($this->connection);
		return $dao->deleteSkillByName($name, $id);
	}
	
	// Job Functions
	public function getAllJobs() {
		$dao = new JobDAO($this->connection);
		return $dao->getAllJobs();
	}
	
	public function addJob($job) {
		$dao = new JobDAO($this->connection);
		return $dao->addJob($job);
	}

	public function editJob($job) {
		$dao = new JobDAO($this->connection);
		return $dao->editJob($job);
	}
	
	public function deleteJobById($id) {
		$dao = new JobDAO($this->connection);
		return $dao->deleteJobById($id);
	}
	
	// Group Functions
	public function createGroup($group) {
		$dao = new GroupDAO($this->connection);
		return $dao->createGroup($group);
	}
	
	public function getAllOwnedGroups() {
		$dao = new GroupDAO($this->connection);
		return $dao->getAllOwnedGroups();
	}
	
	public function getGroupById($id) {
		$dao = new GroupDAO($this->connection);
		return $dao->getGroupById($id);
	}
	
	public function getAllUsersInGroup($group) {
		$dao = new GroupDAO($this->connection);
		return $dao->getAllUsersInGroup($group);
	}
	
	public function getAllGroups() {
		$dao = new GroupDAO($this->connection);
		return $dao->getAllGroups();
	}
	
	public function getAllUserConnectedGroups() {
		$dao = new GroupDAO($this->connection);
		return $dao->getAllUserConnectedGroups();
	}
	
	public function joinGroup($userID, $groupID) {
		$dao = new GroupDAO($this->connection);
		return $dao->joinGroup($userID, $groupID);
	}
	
	public function leaveGroup($userID, $groupID) {
		$dao = new GroupDAO($this->connection);
		return $dao->leaveGroup($userID, $groupID);
	}
}

