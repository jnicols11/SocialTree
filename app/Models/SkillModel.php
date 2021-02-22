<?php

namespace App\Models;

class SkillModel {
	private $name;
	private $users_id;
	
	public function __construct($name, $users_id) {
		$this->name = $name;
		$this->users_id = $users_id;
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getUsers_id() {
		return $this->users_id;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param int $users_id
	 */
	public function setUsers_id($users_id) {
		$this->users_id = $users_id;
	}	
}

