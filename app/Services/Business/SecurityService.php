<?php

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\SecurityDAO;

class SecurityService {
	public function register(UserModel $user) {
		$dao = new SecurityDAO();
		return $dao->register($user);
	}
	
	public function login($email, $password) {
		$dao = new SecurityDAO();
		return $dao->login($email, $password);
	}
}

