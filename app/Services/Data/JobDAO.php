<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Models\JobModel;

class JobDAO {
	private $connection;

	public function __construct($connection) {
        Log::info('Creating instance of JobDAO');
		$this->connection = $connection;
	}

	public function getAllJobs() {
        // Log Function Entry
        Log::info('Entering function getAllJobs in class JobDAO');

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

        // Log Function Exit
        Log::info('Exiting function getAllJobs in class JobDAO');

		return $jobs;
	}

	public function addJob($job) {
        // Log Function Entry
        Log::info('Entering function addJob in class JobDAO');

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
            // Log Function Exit
            Log::info('Exiting function addJob in class JobDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in addJob in class JobDAO');

		return false;
	}

	public function editJob($job) {
        // Log Function Entry
        Log::info('Entering function editJob in class JobDAO');

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
            // Log Function Exit
            Log::info('Exiting function editJob in class JobDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in editJob in class JobDAO');

		return false;
	}

	public function deleteJobById($id) {
        // Log Function Entry
        Log::info('Entering function deleteJobById in class JobDAO');

		// Generate the query
		$query = "DELETE FROM job WHERE ID = '$id'";

		$result = mysqli_query($this->connection, $query);
		if($result) {
            // Log Function Exit
            Log::info('Exiting function deleteJobById in class JobDAO');

			return true;
		}

        // Log Error
        Log::error('Query Failed in deleteJobById in class JobDAO');

		return false;
	}

	public function getJobById($id) {
        // Log Function Entry
        Log::info('Entering function getJobById in class JobDAO');

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

            // Log Function Exit
            Log::info('Exiting function getJobById in class JobDAO');

			return $job;
		}

        // Log Error
        Log::error('Query Failed in getJobById in class JobDAO');

		return false;
	}
}

