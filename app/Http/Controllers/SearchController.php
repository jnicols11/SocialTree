<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\SecurityService;

class SearchController extends Controller
{
    public function validateRequest(Request $request)
    {
        // Log function entry
        Log::info('Entering function validateRequest in class SearchController');

        // Setup Data Validation Rules
        $rules = ['searchValue' => 'Required | Between:1,50'];

        // Log function exit
        Log::info('Exiting function validateRequest in class SearchController');

        // Validate the data
        $this->validate($request, $rules);
    }

    public function search(Request $request)
    {
        // establish variables from request
        $value = $request->input('searchValue');

        // validate the data
        $this->validateRequest($request);

        // Create instance of Security Service
        $service = new SecurityService();

        // get search results for job matches
        $jobResult = $service->getJobsFromSearch($value);

        // get search results for account matches
        $userResult = $service->getUsersFromSearch($value);

        // get search results for group matches
        $groupResult = $service->getGroupsFromSearch($value);

        $result = [$value, $jobResult, $userResult, $groupResult];

        return view('searchresult', compact('result'));
    }
}
