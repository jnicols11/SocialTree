<?php

namespace App\Services\Data;

use App\Models\GroupModel;
use App\Services\Business\SecurityService;

class GroupDAO {
	private $connection;
	
	public function __construct($connection) {
		$this->connection = $connection;
	}
	
	public function createGroup(GroupModel $group) {
		// Create Variables
		$name = $group->getName();
		$description = $group->getDescription();
		$userID = $group->getUserID();
		
		// prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$description = mysqli_real_escape_string($this->connection, $description);
		
		// generate the query
		$query = "INSERT INTO branch(NAME,DESCRIPTION,users_ID) ";
		$query .= "VALUES ('$name', '$description', '$userID')";
		
		// query the data
		$result = mysqli_query($this->connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
	
	public function getAllOwnedGroups() {
		// Create Variables
		$userID = session('id');
		// generate the query
		$query = "SELECT * FROM branch ";
		$query .= "WHERE users_ID = '$userID'";
		
		// query the data
		$result = mysqli_query($this->connection, $query);
		$groups = [];
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$id = $row['ID'];
			$name = $row['NAME'];
			$description = $row['DESCRIPTION'];
			
			// populate model
			$group = new GroupModel($name, $description, $userID);
			$group->setId($id);
			
			// push model to array
			array_push($groups, $group);
		}
		
		return $groups;
	}
	
	public function getGroupById($id) {
		// generate the query
		$query = "SELECT * FROM branch ";
		$query .= "WHERE ID = '$id'";
		
		// query the data
		$result = mysqli_query($this->connection, $query);
		$group_info = mysqli_fetch_assoc($result);
		
		// set variables
		$name = $group_info['NAME'];
		$description = $group_info['DESCRIPTION'];
		$userID = $group_info['users_ID'];
		
		// populate the model
		$group = new GroupModel($name, $description, $userID);
		$group->setId($id);
		
		return $group;
	}
	
	public function getAllUsersInGroup(GroupModel $group) {
		// Establish Variables
		$groupID = $group->getId();
		$users = [];
		
		// Generate first query
		$query = "SELECT * FROM branchconnection ";
		$query .= "WHERE branch_ID = '$groupID'";
		
		// query the table
		$result = mysqli_query($this->connection, $query);
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$userID = $row['users_ID'];
			
			// Create instance of Security Service
			$service = new SecurityService();
			$user = $service->getUserById($userID);
			
			// add user to array
			array_push($users, $user);
		}
		
		return $users;
	}
	
	public function getAllGroups() {
		// generate the query
		$query = "SELECT * FROM branch";
		
		// query the table
		$result = mysqli_query($this->connection, $query);
		$groups = [];
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$id = $row['ID'];
			$name = $row['NAME'];
			$description = $row['DESCRIPTION'];
			$userID = $row['users_ID'];
			
			// populate the model
			$group = new GroupModel($name, $description, $userID);
			$group->setId($id);
			
			// push group to groups
			array_push($groups, $group);
		}
		
		return groups;
	}
}

