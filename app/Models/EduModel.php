<?php

namespace App\Models;

class EduModel {
	private $name;
	private $degree;
	private $field;
	private $start;
	private $end;
	private $userID;
	
	public function __construct($name, $degree, $field, $start, $end, $userID) {
		$this->name = $name;
		$this->degree = $degree;
		$this->field = $field;
		$this->start = $start;
		$this->end = $end;
		$this->userID = $userID;
	}
	
	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function getDegree() {
		return $this->degree;
	}

	/**
	 * @return mixed
	 */
	public function getField() {
		return $this->field;
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
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param mixed $degree
	 */
	public function setDegree($degree) {
		$this->degree = $degree;
	}

	/**
	 * @param mixed $field
	 */
	public function setField($field) {
		$this->field = $field;
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

