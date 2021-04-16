<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;

class SecurityDAO
{
    private $connection;

    public function __construct($connection)
    {
        Log::info('Creating instance of class SecurityDAO');
        $this->connection = $connection;
    }

    public function register(UserModel $user)
    {
        // Log function entry
        Log::info('Entering function register in class SecurityService');

        // Create variables
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $number = $user->getNumber();
        $password = $user->getPassword();

        // prevent SQL injection
        $firstname = mysqli_real_escape_string($this->connection, $firstname);
        $lastname = mysqli_real_escape_string($this->connection, $lastname);
        $email = mysqli_real_escape_string($this->connection, $email);
        $number = mysqli_real_escape_string($this->connection, $number);
        $password = mysqli_real_escape_string($this->connection, $password);

        // TODO hash and salt password

        // generate the query
        $query = "INSERT INTO users(FIRSTNAME,LASTNAME,EMAIL,NUMBER,PASSWORD) ";
        $query .= "VALUES ('$firstname', '$lastname', '$email', '$number', '$password')";

        // query the data
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            // Log function exit
            Log::info('Exiting function register in class SecurityDAO');

            return true;
        }

        // Log Error
        Log::error('Query Failed in register in class SecurityDAO');

        return false;
    }

    public function login($email, $password)
    {
        // Log function entry
        Log::info('Entering function login in class SecurityService');

        // prevent SQL injection
        $email = mysqli_real_escape_string($this->connection, $email);
        $password = mysqli_real_escape_string($this->connection, $password);

        // TODO hash and salt password

        // generate the query
        $query = "SELECT * FROM users ";
        $query .= "WHERE EMAIL = '$email' ";
        $query .= "AND PASSWORD = '$password'";

        // query table
        $result = mysqli_query($this->connection, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            // User was found, create user info associative array
            $user_info = mysqli_fetch_assoc($result);

            // Create variables
            $firstname = $user_info['FIRSTNAME'];
            $lastname = $user_info['LASTNAME'];
            $email = $user_info['EMAIL'];
            $number = $user_info['NUMBER'];
            $password = $user_info['PASSWORD'];
            $admin = $user_info['ADMIN'];

            // Create User Model
            $user = new UserModel($firstname, $lastname, $email, $number, $password);
            $user->setAdmin($admin);

            // Create sessions
            session_start();
            session(['id' => $user_info['ID']]);
            session(['firstname' => $user->getFirstname()]);
            session(['lastname' => $user->getLastname()]);
            session(['email' => $user->getEmail()]);
            session(['number' => $user->getNumber()]);
            session(['admin' => $user->getAdmin()]);

            // Log function exit
            Log::info('Exiting function login in class SecurityDAO');

            return true;
        }
        // User was not found

        // Log Error
        Log::error('Query Failed in login in class SecurityDAO');

        return false;
    }

    public function getAllUsers()
    {
        // Log function entry
        Log::info('Entering function getAllUsers in class SecurityService');

        // generate the query
        $query = "SELECT * FROM users";

        // query table
        $result = mysqli_query($this->connection, $query);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $user = new UserModel($row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['NUMBER'], $row['PASSWORD']);
            $user->setAdmin($row['ADMIN']);
            $user->setBio($row['BIO']);
            $user->setLocation($row['LOCATION']);
            array_push($users, $user);
        }

        // Log function exit
        Log::info('Exiting function getAllUsers in class SecurityDAO');

        return $users;
    }

    public function getUserByEmail($email)
    {
        // Log function entry
        Log::info('Entering function getUserByEmail in class SecurityService');

        // prevent sql injection
        $email = mysqli_real_escape_string($this->connection, $email);

        // generate the query
        $query = "SELECT * FROM users ";
        $query .= "WHERE EMAIL = '$email'";

        // Query the table
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            // fetch the array
            $user_info = mysqli_fetch_assoc($result);

            // create variables
            $firstname = $user_info['FIRSTNAME'];
            $lastname = $user_info['LASTNAME'];
            $email = $user_info['EMAIL'];
            $number = $user_info['NUMBER'];
            $password = $user_info['PASSWORD'];
            $location = $user_info['LOCATION'];
            $bio = $user_info['BIO'];
            $picture = $user_info['PICTURE'];
            $admin = $user_info['ADMIN'];

            // populate and return model
            $user = new UserModel($firstname, $lastname, $email, $number, $password);
            $user->setLocation($location);
            $user->setBio($bio);
            $user->setPicture($picture);
            $user->setAdmin($admin);

            // Log function exit
            Log::info('Exiting function getUserByEmail in class SecurityDAO');

            return $user;
        }
    }

    public function updateUserByEmail($user, $email)
    {
        // Log function entry
        Log::info('Entering function updateUserByEmail in class SecurityService');

        // Set variables
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $newemail = $user->getEmail();
        $number = $user->getNumber();
        $password = $user->getPassword();
        $location = $user->getLocation();
        $bio = $user->getBio();
        $picture = $user->getPicture();
        $admin = $user->getAdmin();

        // prevent SQL injection
        $firstname = mysqli_real_escape_string($this->connection, $firstname);
        $lastname = mysqli_real_escape_string($this->connection, $lastname);
        $newemail = mysqli_real_escape_string($this->connection, $newemail);
        $number = mysqli_real_escape_string($this->connection, $number);
        $password = mysqli_real_escape_string($this->connection, $password);
        $location = mysqli_real_escape_string($this->connection, $location);
        $bio = mysqli_real_escape_string($this->connection, $bio);
        $picture = mysqli_real_escape_string($this->connection, $picture);
        $admin = mysqli_real_escape_string($this->connection, $admin);

        // Generate the query
        $query = "UPDATE users SET ";
        $query .= "FIRSTNAME = '$firstname', LASTNAME = '$lastname', EMAIL = '$newemail', NUMBER = '$number', ";
        $query .= "PASSWORD = '$password', LOCATION = '$location', BIO = '$bio', PICTURE = '$picture', ADMIN = '$admin' ";
        $query .= "WHERE EMAIL = '$email'";

        // Query the table
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            // user was updated

            // Log function exit
            Log::info('Exiting function updateUserByEmail in class SecurityDAO');

            return true;
        }

        // Log Error
        Log::error('Query Failed in updateUserByEmail in class SecurityDAO');

        return false;
    }

    public function deleteUserByEmail($email)
    {
        // Log function entry
        Log::info('Entering function deleteUserByEmail in class SecurityService');

        // prevent SQL injection
        $email = mysqli_real_escape_string($this->connection, $email);

        // generate the query
        $query = "DELETE FROM users ";
        $query .= "WHERE EMAIL = '$email'";

        // Query the table
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            // Log function exit
            Log::info('Exiting function deleteUserByEmail in class SecurityDAO');

            return true;
        }

        // Log Error
        Log::error('Query Failed in deleteUserByEmail in class SecurityDAO');

        return false;
    }

    public function getUserById($userID)
    {
        // Log function entry
        Log::info('Entering function getUserById in class SecurityService');

        // generate the query
        $query = "SELECT * FROM users ";
        $query .= "WHERE ID = '$userID'";

        // Query the table
        $result = mysqli_query($this->connection, $query);
        $user_info = mysqli_fetch_assoc($result);

        // create variables
        $firstname = $user_info['FIRSTNAME'];
        $lastname = $user_info['LASTNAME'];
        $email = $user_info['EMAIL'];
        $number = $user_info['NUMBER'];
        $password = $user_info['PASSWORD'];
        $location = $user_info['LOCATION'];
        $bio = $user_info['BIO'];
        $picture = $user_info['PICTURE'];
        $admin = $user_info['ADMIN'];

        // populate and return model
        $user = new UserModel($firstname, $lastname, $email, $number, $password);
        $user->setLocation($location);
        $user->setBio($bio);
        $user->setPicture($picture);
        $user->setAdmin($admin);

        // Log function exit
        Log::info('Exiting function getUserById in class SecurityDAO');

        return $user;
    }
}
