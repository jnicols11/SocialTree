<?php

namespace App\Models;

class UserModel {
	private $firstname;
	private $lastname;
	private $email;
	private $number;
	private $password;
	private $location;
	private $bio;
	private $picture;
	private $admin;
	
	// function constructor to populate the user model
	public function __construct($firstname, $lastname, $email, $number, $password) {
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->email = $email;
		$this->number = $number;
		$this->password = $password;
	}
	
	// Getters and Setters
	
	/**
	 * @return String
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @return String
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * @return String
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return mixed
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @return String
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param String $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * @param String $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * @param String $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param String $number
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * @param String $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}
	
	/**
	 * @return mixed
	 */
	public function getLocation() {
		return $this->location;
	}
	
	/**
	 * @return mixed
	 */
	public function getBio() {
		return $this->bio;
	}
	
	/**
	 * @return mixed
	 */
	public function getPicture() {
		return $this->picture;
	}
	
	/**
	 * @return mixed
	 */
	public function getAdmin() {
		return $this->admin;
	}
	
	/**
	 * @param mixed $location
	 */
	public function setLocation($location) {
		$this->location = $location;
	}
	
	/**
	 * @param mixed $bio
	 */
	public function setBio($bio) {
		$this->bio = $bio;
	}
	
	/**
	 * @param mixed $picture
	 */
	public function setPicture($picture) {
		$this->picture = $picture;
	}
	
	/**
	 * @param mixed $admin
	 */
	public function setAdmin($admin) {
		$this->admin = $admin;
	}
	
	
}

