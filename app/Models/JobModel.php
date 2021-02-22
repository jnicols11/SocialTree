<?php

namespace App\Models;

class JobModel {
	private $title;
	private $company;
	private $description;
	private $id;

	public function __construct($title, $company, $description) {
		$this->title = $title;
		$this->company = $company;
		$this->description = $description;
	}
	
	/**
	 * @return String
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return String
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @return String
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param String $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param String $company
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * @param String $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
}

