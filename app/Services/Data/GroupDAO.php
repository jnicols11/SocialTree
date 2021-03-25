<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Models\GroupModel;
use App\Services\Business\SecurityService;

class GroupDAO {
	private $connection;

	public function __construct($connection) {
        Log::info('Creating instance of GroupDAO');
		$this->connection = $connection;
	}

	public function createGroup(GroupModel $group) {
        // Log function entry
        Log::info('Entering function createGroup in class GroupDAO');

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
            // Log function exit
            Log::info('Exiting function createGroup in class GroupDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in createGroup in class GroupDAO');

		return false;
	}

	public function getAllOwnedGroups() {
        // Log function entry
        Log::info('Entering function getAllOwnedGroups in class GroupDAO');

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

        // Log function exit
        Log::info('Exiting function getAllOwnedGroups in class GroupDAO');

		return $groups;
	}

	public function getGroupById($id) {
        // Log function entry
        Log::info('Entering function getGroupById in class GroupDAO');

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

        // Log function exit
        Log::info('Exiting function getGroupById in class GroupDAO');

		return $group;
	}

	public function getAllUsersInGroup(GroupModel $group) {
        // Log function entry
        Log::info('Entering function getAllUsersInGroup in class GroupDAO');

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

        // Log function exit
        Log::info('Exiting function getAllUsersInGroup in class GroupDAO');

		return $users;
	}

	public function getAllGroups() {
        // Log function entry
        Log::info('Entering function getAllGroups in class GroupDAO');

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

        // Log function exit
        Log::info('Exiting function getAllGroups in class GroupDAO');

		return $groups;
	}

	public function getAllUserConnectedGroups() {
        // Log function entry
        Log::info('Entering function getAllUserConnectedGroups in class GroupDAO');

		// establish variables
		$userID = session('id');

		// generate the query
		$query = "SELECT * FROM branchconnection ";
		$query .= "WHERE users_ID = '$userID'";

		// query the table
		$result = mysqli_query($this->connection, $query);
		$groupIDs = [];
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$groupID = $row['branch_ID'];

			// push branch ID to array
			array_push($groupIDs, $groupID);
		}

        // Log function exit
        Log::info('Exiting function getAllUserConnectedGroups in class GroupDAO');

		return $groupIDs;
	}

	public function joinGroup($userID, $groupID) {
        // Log function entry
        Log::info('Entering function joinGroup in class GroupDAO');

		// generate the query
		$query = "INSERT INTO branchconnection (users_ID, branch_ID) ";
		$query .= "VALUES ('$userID', '$groupID')";

		// query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function joinGroup in class GroupDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in joinGroup in GroupDAO');

		return false;
	}

	public function leaveGroup($userID, $groupID) {
        // Log function entry
        Log::info('Entering function leaveGroup in class GroupDAO');

		// generate the query
		$query = "DELETE FROM branchconnection ";
		$query .= "WHERE users_ID = '$userID' ";
		$query .= "AND branch_ID = '$groupID'";

		// query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function leaveGroup in class GroupDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in leaveGroup in GroupDAO');

		return false;
	}
}

