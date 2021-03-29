<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// get all jobs (GET) /api/user/{id}
Route::get('/user/{id}', 'UserController@getUserForApi');

// get a single job (GET) /api/job/{id}
Route::get('/jobs/{id}', 'JobController@getJobForApi');

// get all jobs (GET) /api/jobs
Route::get('/jobs', 'JobController@getAllJobsForApi');

Route::get('/testapi', function () {
    return ['message' => 'hello'];
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
