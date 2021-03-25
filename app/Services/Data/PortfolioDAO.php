<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Models\WorkModel;
use App\Models\EduModel;
use App\Models\SkillModel;

class PortfolioDAO {
	private $connection;

	public function __construct($connection) {
        Log::info('Creating instance of PortfolioDAO');
		$this->connection = $connection;
	}

	public function getWorkHistoryById($id) {
        // Log function entry
        Log::info('Entering function getWorkHistoryByID in class PortfolioDAO');

		// generate the query
		$query = "SELECT * FROM work ";
		$query .= "WHERE users_ID = '$id'";

		$result = mysqli_query($this->connection, $query);
		$workHistory = [];
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$company = $row['COMPANY'];
			$title = $row['TITLE'];
			$description = $row['DESCRIPTION'];
			$start = $row['START'];
			$end = $row['END'];

			$work = new WorkModel($company, $title, $description, $start, $end, $id);
			array_push($workHistory, $work);
		}

        // Log function exit
        Log::info('Exiting function getWorkHistoryById in class PortfolioDAO');

		return $workHistory;
	}

	public function getEduHistoryById($id) {
        // Log function entry
        Log::info('Entering function getEduHistoryByID in class PortfolioDAO');

		// generate the query
		$query = "SELECT * FROM edu ";
		$query .= "WHERE users_ID = '$id'";

		$result = mysqli_query($this->connection, $query);
		$eduHistory = [];
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$name = $row['NAME'];
			$degree = $row['DEGREE'];
			$field = $row['FIELD'];
			$start = $row['START'];
			$end = $row['END'];

			$edu = new EduModel($name, $degree, $field, $start, $end, $id);
			array_push($eduHistory, $edu);
		}

        // Log function exit
        Log::info('Exiting function getEduHistoryById in class PortfolioDAO');

		return $eduHistory;
	}

	public function getSkillsById($id) {
        // Log function entry
        Log::info('Entering function getWSkillsById in class PortfolioDAO');

		// generate the query
		$query = "SELECT * FROM skill ";
		$query .= "WHERE users_ID = '$id'";

		$result = mysqli_query($this->connection, $query);
		$skills = [];
		while($row = mysqli_fetch_assoc($result)) {
			// set variables
			$name = $row['NAME'];

			$skill = new SkillModel($name, $id);
			array_push($skills, $skill);
		}

        // Log function exit
        Log::info('Exiting function getSkillsById in class PortfolioDAO');

		return $skills;
	}

	public function addWorkExperience(WorkModel $work) {
        // Log function entry
        Log::info('Entering function addWorkExperience in class PortfolioDAO');

		// Create Variables
		$company = $work->getCompany();
		$title = $work->getTitle();
		$description = $work->getDescription();
		$start = $work->getStart();
		$end = $work->getEnd();
		$userID = $work->getUserID();

		// Clean data to prevent SQL injection
		$company = mysqli_real_escape_string($this->connection, $company);
		$title = mysqli_real_escape_string($this->connection, $title);
		$description = mysqli_real_escape_string($this->connection, $description);
		$start = mysqli_real_escape_string($this->connection, $start);
		$end = mysqli_real_escape_string($this->connection, $end);

		// generate the query
		$query = "INSERT INTO work(COMPANY,TITLE,DESCRIPTION,START,END,users_ID) ";
		$query .= "VALUES ('$company', '$title', '$description', '$start', '$end', '$userID')";

		// query the data
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function addWorkExperience in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in addWorkExperience in class PortfolioController');

		return false;
	}

	public function addEdu(EduModel $edu) {
        // Log function entry
        Log::info('Entering function addEdu in class PortfolioDAO');

		// Create Variables
		$name = $edu->getName();
		$degree = $edu->getDegree();
		$field = $edu->getField();
		$start = $edu->getStart();
		$end = $edu->getEnd();
		$userID = $edu->getuserID();

		// Clean Data to prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$degree = mysqli_real_escape_string($this->connection, $degree);
		$field = mysqli_real_escape_string($this->connection, $field);
		$start = mysqli_real_escape_string($this->connection, $start);
		$end = mysqli_real_escape_string($this->connection, $end);
		$userID = mysqli_real_escape_string($this->connection, $userID);

		// generate the query
		$query = "INSERT INTO edu(NAME,DEGREE,FIELD,START,END,users_ID) ";
		$query .= "VALUES ('$name', '$degree', '$field', '$start', '$end', '$userID')";

		// query the data
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function addEdu in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in addEdu in class PortfolioController');

		return false;
	}

	public function addSkill(SkillModel $skill) {
        // Log function entry
        Log::info('Entering function addSkill in class PortfolioDAO');

		// Create Variables
		$name = $skill->getName();
		$userID = $skill->getUsers_id();

		// Clean data to prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$userID = mysqli_real_escape_string($this->connection, $userID);

		// generate the query
		$query = "INSERT INTO skill(NAME,users_ID) ";
		$query .= "VALUES ('$name', '$userID')";

		// query the data
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function addSkill in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in addSkill in class PortfolioController');

		return false;
	}

	public function editWork(WorkModel $work, $oldcompany) {
        // Log function entry
        Log::info('Entering function editWork in class PortfolioDAO');

		// Create Variables
		$company = $work->getCompany();
		$title = $work->getTitle();
		$description = $work->getDescription();
		$start = $work->getStart();
		$end = $work->getEnd();
		$userID = $work->getuserID();

		// Clean data to prevent SQL injection
		$company = mysqli_real_escape_string($this->connection, $company);
		$title = mysqli_real_escape_string($this->connection, $title);
		$description = mysqli_real_escape_string($this->connection, $description);
		$start = mysqli_real_escape_string($this->connection, $start);
		$end = mysqli_real_escape_string($this->connection, $end);
		$userID = mysqli_real_escape_string($this->connection, $userID);
		$oldcompany = mysqli_real_escape_string($this->connection, $oldcompany);

		// generate the query
		$query = "UPDATE work SET ";
		$query .= "COMPANY = '$company', TITLE = '$title', DESCRIPTION = '$description', START = '$start', END = '$end' ";
		$query .= "WHERE COMPANY ='$oldcompany' AND users_ID = '$userID'";

		// Query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
			// work was updated

            // Log function exit
            Log::info('Exiting function editWork in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in editWork in class PortfolioController');

		return false;
	}

	public function editEdu(EduModel $edu, $oldname) {
        // Log function entry
        Log::info('Entering function editEdu in class PortfolioDAO');

		// Create Variables
		$name = $edu->getName();
		$degree = $edu->getDegree();
		$field = $edu->getField();
		$start = $edu->getStart();
		$end = $edu->getEnd();
		$userID = $edu->getuserID();

		// Clean data to prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$degree = mysqli_real_escape_string($this->connection, $degree);
		$field = mysqli_real_escape_string($this->connection, $field);
		$start = mysqli_real_escape_string($this->connection, $start);
		$end = mysqli_real_escape_string($this->connection, $end);
		$userID = mysqli_real_escape_string($this->connection, $userID);
		$oldname = mysqli_real_escape_string($this->connection, $oldname);

		// generate the query
		$query = "UPDATE edu SET ";
		$query .= "NAME = '$name', DEGREE = '$degree', FIELD = '$field', START = '$start', END = '$end' ";
		$query .= "WHERE NAME = '$oldname' AND users_ID = '$userID'";

		// Query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
			// edu was updated

            // Log function exit
            Log::info('Exiting function editEdu in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in editEdu in class PortfolioController');

		return false;
	}

	public function editSkill(SkillModel $skill, $oldname) {
        // Log function entry
        Log::info('Entering function editSkill in class PortfolioDAO');

		// Create Variables
		$name = $skill->getName();
		$userID = $skill->getUsers_id();

		// Clean data to prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$userID = mysqli_real_escape_string($this->connection, $userID);
		$oldname = mysqli_real_escape_string($this->connection, $oldname);

		// generate the query
		$query = "UPDATE skill SET ";
		$query .= "NAME = '$name' ";
		$query .= "WHERE NAME = '$oldname' AND users_ID = '$userID'";

		// Query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
			// skill was updated

            // Log function exit
            Log::info('Exiting function editSkill in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in editSkill in class PortfolioController');

		return false;
	}

	public function deleteWorkExperienceByTitle($title, $id) {
        // Log function entry
        Log::info('Entering function deleteWorkExperienceByTitle in class PortfolioDAO');

		// prevent SQL injection
		$title = mysqli_real_escape_string($this->connection, $title);
		$id = mysqli_real_escape_string($this->connection, $id);

		// generate the query
		$query = "DELETE FROM work WHERE TITLE = '$title' AND users_ID ='$id' LIMIT 1";

		// query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function deleteWorkExperienceByTitle in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in deleteWorkExperienceByTitle in class PortfolioController');

		return false;
	}

	public function deleteEduByNameAndDegree($name, $degree, $id) {
        // Log function entry
        Log::info('Entering function deleteEduByNameAndDegree in class PortfolioDAO');

		// prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$degree = mysqli_real_escape_string($this->connection, $degree);
		$id = mysqli_real_escape_string($this->connection, $id);

		// generate the query
		$query = "DELETE FROM edu WHERE NAME = '$name' AND DEGREE = '$degree' AND users_ID = '$id' LIMIT 1";

		// query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function deleteEduByNameAndDegree in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in deleteEduByNameAndDegree in class PortfolioController');

		return false;
	}

	public function deleteSkillByName($name, $id) {
        // Log function entry
        Log::info('Entering function deleteSkillByName in class PortfolioDAO');

		// prevent SQL injection
		$name = mysqli_real_escape_string($this->connection, $name);
		$id = mysqli_real_escape_string($this->connection, $id);

		$query = "DELETE FROM skill WHERE NAME = '$name' AND users_ID = '$id' LIMIT 1";

		// query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log function exit
            Log::info('Exiting function deleteSkillByName in class PortfolioDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in deleteSkillByName in class PortfolioController');

		return false;
	}
}

