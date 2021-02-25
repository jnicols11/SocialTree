<?php

namespace App\Models;

class GroupModel {
	private $name;
	private $description;
	private $userID;
	private $id;
	
	public function __construct($name, $description, $userID) {
		$this->name = $name;
		$this->description = $description;
		$this->userID = $userID;
	}
	
	/**
	 * @return String
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return String
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return int
	 */
	public function getUserID() {
		return $this->userID;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param String $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param String $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param int $userID
	 */
	public function setUserID($userID) {
		$this->userID = $userID;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
}

