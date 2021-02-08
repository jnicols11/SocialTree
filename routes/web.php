<?php
// Route Homepage
Route::get('/', function () {
    return view('home');
});

// Route Registration Page and Form Submit
Route::get('/register', function () { return view('register'); });
Route::post('doregister', 'UserController@register');

// Route Login Page and Form Submit
Route::get('/login', function () { return view('login'); });
Route::post('dologin', 'UserController@login');

// Route Logout
Route::get('/logout', 'UserController@logout');

// Route profile view
Route::get('/profile', 'UserController@getProfile');
Route::post('doeditprofile', 'UserController@editProfile');

// Administrative Routes
Route::get('/users', 'UserController@getAllUsers');
Route::post('edituser', 'UserController@getUser');
Route::post('deleteuser', 'UserController@deleteUser');
Route::post('doedit', 'UserController@editUser');