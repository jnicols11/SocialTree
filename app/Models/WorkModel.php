<?php

namespace App\Models;

class WorkModel {
	private $company;
	private $title;
	private $description;
	private $start;
	private $end;
	private $userID;
	
	public function __construct($company, $title, $description, $start, $end, $userID) {
		$this->company = $company;
		$this->title = $title;
		$this->description = $description;
		$this->start = $start;
		$this->end = $end;
		$this->userID = $userID;
	}
	
	/**
	 * @return mixed
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return mixed
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * @return mixed
	 */
	public function getEnd() {
		return $this->end;
	}

	/**
	 * @return mixed
	 */
	public function getuserID() {
		return $this->userID;
	}

	/**
	 * @param mixed $company
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param mixed $start
	 */
	public function setStart($start) {
		$this->start = $start;
	}

	/**
	 * @param mixed $end
	 */
	public function setEnd($end) {
		$this->end = $end;
	}

	/**
	 * @param mixed $userID
	 */
	public function setuserID($userID) {
		$this->userID = $userID;
	}
	
}

