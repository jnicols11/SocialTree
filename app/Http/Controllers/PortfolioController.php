<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\SecurityService;
use App\Models\WorkModel;
use App\Models\SkillModel;
use App\Models\EduModel;

class PortfolioController extends Controller
{
    public function validateWork(Request $request)
    {
        // Log function entry
        Log::info('Entering function validateWork in class PortfolioController');

        // Setup Data Validation Rules for Work
        $rules = ['company' => 'Required | Between:2,50', 'title' => 'Required | Between:2,50', 'description' => 'Required', 'start' => 'Required', 'end' => 'Required'];

        // Log function exit
        Log::info('Exiting function validateWork in class PortfolioController');

        // Validate the Data
        $this->validate($request, $rules);
    }

    public function validateEdu(Request $request)
    {
        // Log function entry
        Log::info('Entering function validateEdu in class PortfolioController');

        // Setup Data Validation Rules for EDU
        $rules = ['name' => 'Required | Between:2,50', 'degree' => 'Required | Between:4,50 | Alpha', 'field' => 'Required | Between:2,50 | Alpha', 'start' => 'Required', 'end' => 'Required'];

        // Log function exit
        Log::info('Exiting function validateEdu in class PortfolioController');

        // Validate the Data
        $this->validate($request, $rules);
    }

    public function validateSkill(Request $request)
    {
        // Log function entry
        Log::info('Entering function validateSkill in class PortfolioController');

        // Setup Data Validation Rules for Skills
        $rules = ['name' => 'Required'];

        // Log function exit
        Log::info('Exiting function validateSkill in class PortfolioController');

        // Validate the Data
        $this->validate($request, $rules);
    }

    public function getProfile()
    {
        // Log function entry
        Log::info('Entering function getProfile in class PortfolioController');

        // Create Variables
        $profile = [];
        $email = session('email');
        $id = session('id');

        // Create instance of Security Service
        $service = new SecurityService();

        // populate the user
        $user = $service->getUserByEmail($email);

        // add user to profile
        array_push($profile, $user);

        // Get Work History from Service
        $work_history = $service->getWorkHistoryById($id);

        // add work history to profile
        array_push($profile, $work_history);

        // Get Edu History from service
        $education = $service->getEduHistoryById($id);

        // add edu history to profile
        array_push($profile, $education);

        // get skills from service
        $skills = $service->getSkillsById($id);

        // add skill to profile
        array_push($profile, $skills);

        // Log function exit
        Log::info('Exiting function getProfile in class ProfileController');

        // Send profile array to profile view
        return view('profile', compact('profile'));
    }

    public function getOtherProfile(Request $request)
    {
        // Log function entry
        Log::info('Entering function getOtherProfile in class PortfolioController');

        // Get Variables from Request
        $profile = [];
        $email = $request->input('email');
        $id = $request->input('id');

        // Create instance of Security Service
        $service = new SecurityService();

        // populate the user
        $user = $service->getUserByEmail($email);

        // add user to profile
        array_push($profile, $user);

        // get Work History from Service
        $work_history = $service->getWorkHistoryById($id);

        // add work history to profile
        array_push($profile, $work_history);

        // Get Edu History from service
        $education = $service->getEduHistoryById($id);

        // add edu history to profile
        array_push($profile, $education);

        // get skills from service
        $skills = $service->getSkillsById($id);

        // add skills to profile
        array_push($profile, $skills);

        // Log function exit
        Log::info('Exiting function getOtherProfile in class ProfileController');

        // send profile array to other profile view
        return view('userProfile', compact('profile'));
    }

    public function addWorkExperience(Request $request)
    {
        // Log function entry
        Log::info('Entering function addWorkExperience in class PortfolioController');

        // Establish Variables from Request
        $company = $request->input('company');
        $title = $request->input('title');
        $description = $request->input('description');
        $start = $request->input('start');
        $end = $request->input('end');
        $userID = session('id');

        // Validate the Form Data
        $this->validateWork($request);

        // populate the model
        $work = new WorkModel($company, $title, $description, $start, $end, $userID);

        // Create instance of security Service
        $service = new SecurityService();

        if ($service->addWorkExperience($work)) {
            // Log function exit
            Log::info('Exiting function addWorkExperience in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to add work. Exiting function addWorkExperience in ProfileController');

        return view('workAddFail');
    }

    public function addEdu(Request $request)
    {
        // Log function entry
        Log::info('Entering function addEdu in class PortfolioController');

        // Establish Variables from Request
        $name = $request->input('name');
        $degree = $request->input('degree');
        $field = $request->input('field');
        $start = $request->input('start');
        $end = $request->input('end');
        $userID = session('id');

        // Validate the Form
        $this->validateEdu($request);

        // populate the model
        $edu = new EduModel($name, $degree, $field, $start, $end, $userID);

        // Create instance of Security Service
        $service = new SecurityService();

        if ($service->addEdu($edu)) {
            // Log function exit
            Log::info('Exiting function addEdu in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to add EDU. Exiting function addEdu in ProfileController');

        return view('EduAddFail');
    }

    public function addSkill(Request $request)
    {
        // Log function entry
        Log::info('Entering function addSkill in class PortfolioController');

        // Establish Variables from Request
        $name = $request->input('name');
        $id = session('id');

        // validate the Form Data
        $this->validateSkill($request);

        // populate the model
        $skill = new SkillModel($name, $id);

        // create instance of security service
        $service = new SecurityService();

        if ($service->addSkill($skill)) {
            // Log function exit
            Log::info('Exiting function addSkill in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to add skill. Exiting function addSkill in ProfileController');

        return view('SkillAddFail');
    }

    public function editWork(Request $request)
    {
        // Log function entry
        Log::info('Entering function editWork in class PortfolioController');

        // Establish variables from Request
        $oldcompany = $request->input('oldcompany');
        $company = $request->input('company');
        $title = $request->input('title');
        $description = $request->input('description');
        $start = $request->input('start');
        $end = $request->input('end');
        $userID = session('id');

        // Validate the data
        $this->validateWork($request);

        // populate WorkModel
        $work = new WorkModel($company, $title, $description, $start, $end, $userID);

        // create instance of service
        $service = new SecurityService();

        if ($service->editWork($work, $oldcompany)) {
            // Log function exit
            Log::info('Exiting function editWork in class ProfileController');

            return redirect('/profile');
        }
        // Log Error
        Log::error('Failed to edit work. Exiting function editWork in ProfileController');

        return view('WorkEditFail');
    }

    public function editEdu(Request $request)
    {
        // Log function entry
        Log::info('Entering function editEdu in class PortfolioController');

        // Establish variables from request
        $oldname = $request->input('oldname');
        $name = $request->input('name');
        $degree = $request->input('degree');
        $field = $request->input('field');
        $start = $request->input('start');
        $end = $request->input('end');
        $userID = session('id');

        // Validate the data
        $this->validateEdu($request);

        // populate EduModel
        $edu = new EduModel($name, $degree, $field, $start, $end, $userID);

        // create instance of service
        $service = new SecurityService();

        if ($service->editEdu($edu, $oldname)) {
            // Log function exit
            Log::info('Exiting function editEdu in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to edit EDU. Exiting function editEdi in ProfileController');

        return view('EditEduFail');
    }

    public function editSkill(Request $request)
    {
        // Log function entry
        Log::info('Entering function editSkill in class PortfolioController');

        // Establish variables from request
        $oldname = $request->input('oldname');
        $name = $request->input('name');
        $users_id = session('id');

        // validate the data
        $this->validateSkill($request);

        // populate SkillModel
        $skill = new SkillModel($name, $users_id);

        // create instance of service
        $service = new SecurityService();

        if ($service->editSkill($skill, $oldname)) {
            // Log function exit
            Log::info('Exiting function editSkill in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to edit skill. Exiting function editSkill in ProfileController');

        return view('EditSkillFail');
    }

    public function deleteWorkExperience(Request $request)
    {
        // Log function entry
        Log::info('Entering function deleteWorkExperience in class PortfolioController');

        // establish variables from request
        $id = session('id');
        $title = $request->input('title');

        // Create instance of security service
        $service = new SecurityService();

        if ($service->deleteWorkExperienceByTitle($title, $id)) {
            // Log function exit
            Log::info('Exiting function deleteWorkExperience in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to delete Work. Exiting function deleteWork in ProfileController');

        return view('deleteWorkFail');
    }

    public function deleteEdu(Request $request)
    {
        // Log function entry
        Log::info('Entering function deleteEdu in class PortfolioController');

        // establish variables from request
        $id = session('id');
        $name = $request->input('name');
        $degree = $request->input('degree');

        // Create instance of security service
        $service = new SecurityService();

        if ($service->deleteEduByNameAndDegree($name, $degree, $id)) {
            // Log function exit
            Log::info('Exiting function deleteEdu in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to delete EDU. Exiting function deleteEud in ProfileController');

        return view('deleteEduFail');
    }

    public function deleteSkill(Request $request)
    {
        // Log function entry
        Log::info('Entering function deleteSkill in class PortfolioController');

        // establish variables from request
        $id = session('id');
        $name = $request->input('name');

        // create instance of security service
        $service = new SecurityService();

        if ($service->deleteSkillByName($name, $id)) {
            // Log function exit
            Log::info('Exiting function deleteSkill in class ProfileController');

            return redirect('/profile');
        }

        // Log Error
        Log::error('Failed to delete skill. Exiting function deleteSkill in ProfileController');
        return view('deleteSkillFail');
    }
}
