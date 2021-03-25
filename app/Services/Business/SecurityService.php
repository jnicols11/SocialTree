<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\PortfolioDAO;
use App\Services\Data\JobDAO;
use App\Services\Data\GroupDAO;
use App\Services\Data\SearchDAO;

class SecurityService {
	private $connection;

	public function __construct() {
        Log::info('Creating instance of SecurityService');
		$this->connection = $this->getConnection();
	}

	private function getConnection() {
        Log::info('Getting Connection for SecurityService');
		// Establish connection
		$connection = mysqli_connect('localhost', 'root', '', 'socialtree');
		if(!$connection) {
            Log::error('Failed to get connection. Exiting class SecurityService');
			die("Database connection failed");
		}

		return $connection;
	}

	// User Functions
	public function register(UserModel $user) {
        // Log function entry
        Log::info('Entering function register in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function register in class SecurityService');

		return $dao->register($user);
	}

	public function login($email, $password) {
        // Log function entry
        Log::info('Entering function login in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function login in class SecurityService');

		return $dao->login($email, $password);
	}

	public function getAllUsers() {
        // Log function entry
        Log::info('Entering function getAllUsers in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getAllUsers in class SecurityService');

		return $dao->getAllUsers();
	}

	public function getUserByEmail($email) {
        // Log function entry
        Log::info('Entering function getUserByEmail in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getUserByEmail in class SecurityService');

		return $dao->getUserByEmail($email);
	}

	public function updateUserByEmail($user, $email) {
        // Log function entry
        Log::info('Entering function updateUserByEmail in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function updateUserByEmail in class SecurityService');

		return $dao->updateUserByEmail($user, $email);
	}

	public function deleteUserByEmail($email) {
        // Log function entry
        Log::info('Entering function deleteUserByEmail in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function deleteUserByEmail in class SecurityService');

		return $dao->deleteUserByEmail($email);
	}

	public function getUserById($userID) {
        // Log function entry
        Log::info('Entering function getUserById in class SecurityService');

		$dao = new SecurityDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getUserById in class SecurityService');

		return $dao->getUserById($userID);
	}

	// Portfolio Functions
	public function getWorkHistoryById($id) {
        // Log function entry
        Log::info('Entering function getWorkHistoryById in class SecurityService');

		$dao = new PortfolioDAO($this->connection);
		$work = $dao->getWorkHistoryById($id);

        // Log function exit
        Log::info('Exiting function getWorkHistoryById in class SecurityService');

		return $work;
	}

	public function getEduHistoryById($id) {
        // Log function entry
        Log::info('Entering function getEduHistoryById in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getEduHistoryById in class SecurityService');

		return $dao->getEduHistoryById($id);
	}

	public function getSkillsById($id) {
        // Log function entry
        Log::info('Entering function getSkillsById in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getSkillsById in class SecurityService');

		return $dao->getSkillsById($id);
	}

	public function addWorkExperience($work) {
        // Log function entry
        Log::info('Entering function addWorkExperience in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function addWorkExperience in class SecurityService');

		return $dao->addWorkExperience($work);
	}

	public function addEdu($edu) {
        // Log function entry
        Log::info('Entering function addEdu in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function addEdu in class SecurityService');

		return $dao->addEdu($edu);
	}

	public function addSkill($skill) {
        // Log function entry
        Log::info('Entering function addSkill in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function addSkill in class SecurityService');

		return $dao->addSkill($skill);
	}

	public function editWork($work, $oldcompany) {
        // Log function entry
        Log::info('Entering function editWork in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function editWork in class SecurityService');

		return $dao->editWork($work, $oldcompany);
	}

	public function editEdu($edu, $oldname) {
        // Log function entry
        Log::info('Entering function editEdu in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function editEdu in class SecurityService');

		return $dao->editEdu($edu, $oldname);
	}

	public function editSkill($skill, $oldname) {
        // Log function entry
        Log::info('Entering function editSkill in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function editSkill in class SecurityService');

		return $dao->editSkill($skill, $oldname);
	}

	public function deleteWorkExperienceByTitle($title, $id) {
        // Log function entry
        Log::info('Entering function deleteWorkExperienceByTitle in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function deleteWorkExperienceByTitle in class SecurityService');

		return $dao->deleteWorkExperienceByTitle($title, $id);
	}

	public function deleteEduByNameAndDegree($name, $degree, $id) {
        // Log function entry
        Log::info('Entering function deleteEduByNameAndDegree in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function deleteEduByNameAndDegree in class SecurityService');

		return $dao->deleteEduByNameAndDegree($name, $degree, $id);
	}

	public function deleteSkillByName($name, $id) {
        // Log function entry
        Log::info('Entering function deleteSkillByName in class SecurityService');

		$dao = new PortfolioDAO($this->connection);

        // Log function exit
        Log::info('Exiting function deleteSkillByName in class SecurityService');

		return $dao->deleteSkillByName($name, $id);
	}

	// Job Functions
	public function getAllJobs() {
        // Log function entry
        Log::info('Entering function getAllJobs in class SecurityService');

		$dao = new JobDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getAllJobs in class SecurityService');

		return $dao->getAllJobs();
	}

	public function addJob($job) {
        // Log function entry
        Log::info('Entering function addJob in class SecurityService');

		$dao = new JobDAO($this->connection);

        // Log function exit
        Log::info('Exiting function addJob in class SecurityService');

		return $dao->addJob($job);
	}

	public function editJob($job) {
        // Log function entry
        Log::info('Entering function editJob in class SecurityService');

		$dao = new JobDAO($this->connection);

        // Log function exit
        Log::info('Exiting function editJob in class SecurityService');

		return $dao->editJob($job);
	}

	public function deleteJobById($id) {
        // Log function entry
        Log::info('Entering function deleteJobById in class SecurityService');

		$dao = new JobDAO($this->connection);

        // Log function exit
        Log::info('Exiting function deleteJobById in class SecurityService');

		return $dao->deleteJobById($id);
	}

	public function getJobById($id) {
        // Log function entry
        Log::info('Entering function getJobById in class SecurityService');

		$dao = new JobDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getJobById in class SecurityService');

		return $dao->getJobById($id);
	}

	// Group Functions
	public function createGroup($group) {
        // Log function entry
        Log::info('Entering function createGroup in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function createGroup in class SecurityService');

		return $dao->createGroup($group);
	}

	public function getAllOwnedGroups() {
        // Log function entry
        Log::info('Entering function getAllOwnedGroups in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getAllOwnedGroups in class SecurityService');

		return $dao->getAllOwnedGroups();
	}

	public function getGroupById($id) {
        // Log function entry
        Log::info('Entering function getGroupById in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getGroupId in class SecurityService');

		return $dao->getGroupById($id);
	}

	public function getAllUsersInGroup($group) {
        // Log function entry
        Log::info('Entering function getAllUsersInGroup in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getAllUsersInGroup in class SecurityService');

		return $dao->getAllUsersInGroup($group);
	}

	public function getAllGroups() {
        // Log function entry
        Log::info('Entering function getAllGroups in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getAllGroups in class SecurityService');

		return $dao->getAllGroups();
	}

	public function getAllUserConnectedGroups() {
        // Log function entry
        Log::info('Entering function getAllUserConnectedGroups in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getAllUserConnectedGroups in class SecurityService');

		return $dao->getAllUserConnectedGroups();
	}

	public function joinGroup($userID, $groupID) {
        // Log function entry
        Log::info('Entering function joinGroup in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function joinGroup in class SecurityService');

		return $dao->joinGroup($userID, $groupID);
	}

	public function leaveGroup($userID, $groupID) {
        // Log function entry
        Log::info('Entering function leaveGroup in class SecurityService');

		$dao = new GroupDAO($this->connection);

        // Log function exit
        Log::info('Exiting function leaveGroup in class SecurityService');

		return $dao->leaveGroup($userID, $groupID);
	}

	// Search Functions
	public function getJobsFromSearch($value) {
        // Log function entry
        Log::info('Entering function getJobsFromSearch in class SecurityService');

		$dao = new SearchDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getJobsFromSearch in class SecurityService');

		return $dao->getJobsFromSearch($value);
	}

	public function getUsersFromSearch($value) {
        // Log function entry
        Log::info('Entering function getUsersFromSearch in class SecurityService');

		$dao = new SearchDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getUsersFromSearch in class SecurityService');

		return $dao->getUsersFromSearch($value);
	}

	public function getGroupsFromSearch($value) {
        // Log function entry
        Log::info('Entering function getGroupsFromSearch in class SecurityService');

		$dao = new SearchDAO($this->connection);

        // Log function exit
        Log::info('Exiting function getGroupsFromSearch in class SecurityService');

		return $dao->getGroupsFromSearch($value);
	}
}

