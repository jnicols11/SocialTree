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
	