<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\GroupModel;
use App\Services\Business\SecurityService;

class GroupController extends Controller
{
    public function validateGroup(Request $request)
    {
        // TODO
        // Log Function Entry
        Log::info("Entering function validateGroup in class GroupController");

        // Log Function Exit
        Log::info("Leaving function validateGroup in class GroupController");
    }

    public function createGroup(Request $request)
    {
        // Log Function Entry
        Log::info("Entering function createGroup in class GroupController");

        // Validate the input
        $this->validateGroup($request);

        // Establish Variables from Request
        $name = $request->input('name');
        $description = $request->input('description');
        $userID = session('id');

        // populate Group Model
        $group = new GroupModel($name, $description, $userID);

        // create instance of service
        $service = new SecurityService();

        if ($service->createGroup($group)) {
            // Log Function Exit
            Log::info('Group Create Successfully! Leaving Function createGroup in class GroupController');
            return redirect('/');
        }

        // Log Function Error
        Log::error('Creating Group Failed! Leaving function createGroup in class GroupController');

        return view('CreateGroupFail');
    }

    public function viewGroupPage(Request $request)
    {
        // Log function entry
        Log::info('Entering function viewGroupPage in class GroupController');

        // Establish variables from Request
        $groupID = $request->input('groupID');

        // create instance of service
        $service = new SecurityService();

        // populate model via service
        $group = $service->getGroupById($groupID);

        // get owner of group
        $owner = $service->getUserById($group->getUserID());

        // get all users connected to group
        $users = $service->getAllUsersInGroup($group);

        // Create model array
        $models = [];

        // push models to array
        array_push($models, $group);
        array_push($models, $owner);
        array_push($models, $users);

        // Log function exit
        Log::info('Exiting function viewGroupPage in class GroupController');

        return view('GroupPage', compact('models'));
    }

    public function getAllGroups()
    {
        // Log function entry
        Log::info('Entering function getAllGroups in class GroupController');

        // create return array
        $model = [];

        // establish instance of service
        $service = new SecurityService();

        // populate groups array from service
        $groups = $service->getAllGroups();

        // add groups to return array
        array_push($model, $groups);

        // get all groups user is a member of
        $userGroups = $service->getAllUserConnectedGroups();

        // add user groups to return array
        array_push($model, $userGroups);

        // Log function exit
        Log::info('Exiting function getAllGroups in class GroupController');

        // pass groups to view
        return view('groups', compact('model'));
    }

    public function joinGroup(Request $request)
    {
        // Log function entry
        Log::info('Entering function joinGroup in class GroupController');

        // Establish Variables from request
        $groupID = $request->input('groupID');
        $userID = session('id');

        // Create instanct of Security Service
        $service = new SecurityService();

        if ($service->joinGroup($userID, $groupID)) {
            // Log function exit
            Log::info('Group Joined Successfully! Exiting function joinGroup in class GroupController');

            return redirect('/groups');
        }

        // Log Error
        Log::error('Failed to join group! Leaving function joinGroup in class GroupController');

        return view('joinGroupFail');
    }

    public function leaveGroup(Request $request)
    {
        // Log function entry
        Log::info('Entering function leaveGroup in class GroupController');

        // Establish Variables from request
        $groupID = $request->input('groupID');
        $userID = session('id');

        // Create instance of Security Service
        $service = new SecurityService();

        if ($service->leaveGroup($userID, $groupID)) {
            // Log function exit
            Log::info('Group left Successfully! Exiting function leaveGroup in class GroupController');

            return redirect('/groups');
        }

        // Log Error
        Log::error('Failed to leave group! Leaving function leaveGroup in class GroupController');

        return view('leaveGroupFail');
    }
}
