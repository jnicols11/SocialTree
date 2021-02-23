<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobModel;
use App\Services\Business\SecurityService;

class JobController extends Controller
{
	public function getAllJobs() {
		// Create instance of service
		$service = new SecurityService();
		
		$jobs = $service->getAllJobs();
		return view('jobs', compact('jobs'));
	}
	
	public function addJob(Request $request) {
		// Establish variables from Request
		$title = $request->input('title');
		$company = $request->input('company');
		$description = $request->input('description');
		
		// populate job model
		$job = new JobModel($title, $company, $description);
		
		// Create instance of service
		$service = new SecurityService();
		
		if($service->addJob($job)) {
			return redirect('/jobs');
		}
		
		return view('AddJobFail');
	}
	
	public function editJob(Request $request) {
		// Establish variables from Request
		$title = $request->input('title');
		$company = $request->input('company');
		$description = $request->input('description');
		$id = $request->input('id');
		
		// populate the job model
		$job = new JobModel($title, $company, $description);
		$job->setId($id);
		
		// create instance of service
		$service = new SecurityService();
		
		if($service->editJob($job)) {
			return redirect('/jobs');
		}
		
		return view('EditJobFail');
	}
	
	public function deleteJob(Request $request) {
		// Establish Variables from Request
		$id = $request->input('id');
		
		// Create instance of Security Service
		$service = new SecurityService();
		
		if($service->deleteJobById($id)) {
			return redirect('/jobs');
		}
		
		return view('DeleteJobFail');
	}
}
