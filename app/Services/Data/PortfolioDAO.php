<?php

namespace App\Services\Data;

use App\Models\WorkModel;

class PortfolioDAO {
	private $connection;
	
	public function __construct($connection) {
		$this->connection = $connection;
	}
	
	public function getWorkHistoryById($id) {
		
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
		
		return $workHistory;
	}
	
	public function addWorkExperience($work) {
		
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
			return true;
		}
		
		return false;
	}
	
	public function deleteWorkExperienceByTitle($title, $id) {
		// prevent SQL injection
		$title = mysqli_real_escape_string($this->connection, $title);
		$id = mysqli_real_escape_string($this->connection, $id);
		
		// generate the query
		$query = "DELETE FROM work WHERE TITLE = '$title' AND users_ID ='$id'";
		
		// query the table
		$result = mysqli_query($this->connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
}

