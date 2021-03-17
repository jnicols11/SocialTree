<?php
// Route Homepage
Route::get('/', 'HomeController@goHome');

// Route Registration Page and Form Submit
Route::get('/register', function () {
    return view('register');
});
Route::post('doregister', 'UserController@register');

// Route Login Page and Form Submit
Route::get('/login', function () {
    return view('login');
});
Route::post('dologin', 'UserController@login');

// Route Logout
Route::get('/logout', 'UserController@logout');

// Route profile view
Route::get('/profile', 'PortfolioController@getProfile');
Route::post('doeditprofile', 'UserController@editProfile');
Route::post('goToUser', 'PortfolioController@getOtherProfile');

// Administrative Routes
// User Administration
Route::get('/users', 'UserController@getAllUsers');
Route::post('edituser', 'UserController@getUser');
Route::post('deleteuser', 'UserController@deleteUser');
Route::post('doedit', 'UserController@editUser');
// job administration
Route::get('/jobs', 'JobController@getAllJobs');
Route::post('addJob', 'JobController@addJob');
Route::post('editJob', 'JobController@editJob');
Route::post('deleteJob', 'JobController@deleteJob');

// Route E-Portfolio
// Route E-portfolio Create Routes
Route::post('addWorkExperience', 'PortfolioController@addWorkExperience');
Route::post('addEdu', 'PortfolioController@addEdu');
Route::post('addSkill', 'PortfolioController@addSkill');
// Route E-portfolio Update Routes
Route::post('editWork', 'PortfolioController@editWork');
Route::post('editEdu', 'PortfolioController@editEdu');
Route::post('editSkill', 'PortfolioController@editSkill');
// Route E-portfolio Delete Routes
Route::post('deleteWorkExperience', 'PortfolioController@deleteWorkExperience');
Route::post('deleteEdu', 'PortfolioController@deleteEdu');
Route::post('deleteSkill', 'PortfolioController@deleteSkill');

// Route Affinity Groups
Route::get('/groups', 'GroupController@getAllGroups');
Route::get('goToAddGroup', function () {
    return view('addGroup');
});
Route::post('createGroup', 'GroupController@createGroup');
Route::post('viewGroupPage', 'GroupController@viewGroupPage');
Route::post('joinGroup', 'GroupController@joinGroup');
Route::post('leaveGroup', 'GroupController@leaveGroup');

// Route Search
Route::post('doSearch', 'SearchController@search');

// Route Job
Route::post('goToJob', 'JobController@goToJob');
