<?php

namespace App\Services\Data;

use App\Models\JobModel;

class JobDAO {
	private $connection;
	
	public function __construct($connection) {
		$this->connection = $connection;
	}
	
	public function getAllJobs() {
		// Generate the Query
		$query = "SELECT * FROM job";
		
		// query the table
		$result = mysqli_query($this->connection, $query);
		$jobs = [];
		while($row = mysqli_fetch_assoc($result)) {
			$job = new JobModel($row['TITLE'], $row['COMPANY'], $row['DESCRIPTION']);
			$job->setId($row['ID']);
			array_push($jobs, $job);
		}
		
		return $jobs;
	}
	
	public function addJob($job) {
		// Create Variables
		$title = $job->getTitle();
		$company = $job->getCompany();
		$description = $job->getDescription();
		
		// Clean data to prevent SQL injection
		$title = mysqli_real_escape_string($this->connection, $title);
		$company = mysqli_real_escape_string($this->connection, $company);
		$description = mysqli_real_escape_string($this->connection, $description);
		
		// Generate the query
		$query = "INSERT INTO job (TITLE,COMPANY,DESCRIPTION) ";
		$query .= "VALUES ('$title', '$company', '$description')";
		
		$result = mysqli_query($this->connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
	
	public function editJob($job) {
		// Create Variables
		$title = $job->getTitle();
		$company = $job->getCompany();
		$description = $job->getDescription();
		$id = $job->getId();
		
		// Clean data to prevent SQL injection
		$title = mysqli_real_escape_string($this->connection, $title);
		$company = mysqli_real_escape_string($this->connection, $company);
		$description = mysqli_real_escape_string($this->connection, $description);
		
		// Generate the query
		$query = "UPDATE job SET ";
		$query .= "TITLE = '$title', COMPANY = '$company', DESCRIPTION = '$description' ";
		$query .= "WHERE ID = '$id'";
		
		$result = mysqli_query($this->connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
	
	public function deleteJobById($id) {
		// Generate the query
		$query = "DELETE FROM job WHERE ID = '$id'";
		
		$result = mysqli_query($this->connection, $query);
		if($result) {
			return true;
		}
		
		return false;
	}
	
	public function getJobById($id) {
		// Generate the query
		$query = "SELECT * FROM job WHERE ID = '$id' LIMIT 1";
		
		$result = mysqli_query($this->connection, $query);
		while($row = mysqli_fetch_assoc($result)) {
			// create variables
			$title = $row['TITLE'];
			$company = $row['COMPANY'];
			$description = $row['DESCRIPTION'];
			$job = new JobModel($title, $company, $description);
			$job->setId($id);
			
			return $job;
		}
		
		return false;
	}
}

