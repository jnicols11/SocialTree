<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\JobModel;
use App\Services\Business\SecurityService;
use Illuminate\Database\Eloquent\Collection;

class JobController extends Controller
{
    public function getAllJobs()
    {
        // Log function entry
        Log::info('Entering function getAllJobs in class JobController');

        // Create instance of service
        $service = new SecurityService();

        $jobs = $service->getAllJobs();

        // Log function exit
        Log::info('Exiting function getAllJobs in class JobController');

        return view('jobs', compact('jobs'));
    }

    public function getAllJobsForApi()
    {
        // Log function entry
        Log::info('Entering function getAllJobsForApi in class JobController');

        // Create instance of service
        $service = new SecurityService();

        // Get all jobs from the service
        $jobs = $service->getAllJobs();

        // Serialize all jobs to Json
        $json = json_encode($jobs);

        // Log function exit
        Log::info('Exiting function getAllJobsForApi in class JobController');

        return $json;
    }

    public function getJobForApi($id)
    {
        // Log function entry
        Log::info('Entering function getJobForApi in class JobController');

        // Create instance of service
        $service = new SecurityService();

        // Get job from service
        $job = $service->getJobById($id);

        // Serialize the job to Json
        $json = json_encode($job);

        // Log function exit
        Log::info('Exiting function getJobForApi in class JobController');

        return $json;
    }

    public function addJob(Request $request)
    {
        // Log function entry
        Log::info('Entering function addJob in class JobController');

        // Establish variables from Request
        $title = $request->input('title');
        $company = $request->input('company');
        $description = $request->input('description');

        // populate job model
        $job = new JobModel($title, $company, $description);

        // Create instance of service
        $service = new SecurityService();

        if ($service->addJob($job)) {
            // Log function exit
            Log::info('Exiting function addJob in class JobController');

            return redirect('/jobs');
        }

        // Log Error
        Log::error('Failed to add job! Exiting function addJob in class JobController');

        return view('AddJobFail');
    }

    public function editJob(Request $request)
    {
        // Log function entry
        Log::info('Entering function editJob in class JobController');

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

        if ($service->editJob($job)) {
            // Log function exit
            Log::info('Exiting function editJob in class JobController');

            return redirect('/jobs');
        }

        // Log Error
        Log::error('Failed to edit job! Exiting function editJob in class JobController');

        return view('EditJobFail');
    }

    public function deleteJob(Request $request)
    {
        // Log function entry
        Log::info('Entering function deleteJob in class JobController');

        // Establish Variables from Request
        $id = $request->input('id');

        // Create instance of Security Service
        $service = new SecurityService();

        if ($service->deleteJobById($id)) {
            // Log function exit
            Log::info('Exiting function editJob in class JobController');

            return redirect('/jobs');
        }

        // Log Error
        Log::error('Failed to delete job! Exiting function deleteJob in class JobController');

        return view('DeleteJobFail');
    }

    public function goToJob(Request $request)
    {
        // Log function entry
        Log::info('Entering function goToJob in class JobController');

        // Establish Variables from Request
        $id = $request->input('jobID');

        // Create instance of Security Service
        $service = new SecurityService();

        // populate model
        $job = $service->getJobById($id);

        // Log function exit
        Log::info('Exiting function goToJob in class JobController');

        // return view
        return view('jobpage', ['job' => $job]);
    }
}
