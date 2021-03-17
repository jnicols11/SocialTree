<?php

namespace App\Services\Data;

use App\Models\JobModel;
use App\Models\UserModel;
use App\Models\GroupModel;

class SearchDAO
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getJobsFromSearch($value)
    {

        // cleanse data to prevent SQL injection
        $value = mysqli_real_escape_string($this->connection, $value);

        // generate the query
        $query = "SELECT * FROM job WHERE TITLE LIKE '$value' OR COMPANY LIKE '$value' OR DESCRIPTION LIKE '$value'";

        // query the table
        $result = mysqli_query($this->connection, $query);
        $jobs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $job = new JobModel($row['TITLE'], $row['COMPANY'], $row['DESCRIPTION']);
            $job->setId($row['ID']);
            array_push($jobs, $job);
        }

        return $jobs;
    }

    public function getUsersFromSearch($value)
    {

        // Cleanse data to prevent SQL injection
        $value = mysqli_real_escape_string($this->connection, $value);

        // generate the query
        $query = "SELECT * FROM users WHERE FIRSTNAME LIKE '$value' OR LASTNAME LIKE '$value' OR EMAIL LIKE '$value'";

        // query the table
        $result = mysqli_query($this->connection, $query);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $user = new UserModel($row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['NUMBER'], $row['PASSWORD']);
            $user->setAdmin($row['ADMIN']);
            $user->setBio($row['BIO']);
            $user->setLocation($row['LOCATION']);
            $user->setId($row['ID']);
            array_push($users, $user);
        }

        return $users;
    }

    public function getGroupsFromSearch($value)
    {

        // Cleanse data to prevent SQL injection
        $value = mysqli_real_escape_string($this->connection, $value);

        // generate the query
        $query = "SELECT * FROM branch WHERE NAME LIKE '$value' OR DESCRIPTION LIKE '$value'";

        // query the data
        $result = mysqli_query($this->connection, $query);
        $groups = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // set variables
            $id = $row['ID'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $userID = $row['users_ID'];

            // populate model
            $group = new GroupModel($name, $description, $userID);
            $group->setId($id);

            // push model to array
            array_push($groups, $group);
        }

        return $groups;
    }
}
