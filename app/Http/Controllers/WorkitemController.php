<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Workitem;
use App\Models\UserProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkitemController extends Controller
{
    /**
     * Show the table of workitems
     */
    public function index()
    {
            // Retrieve data from the database
            $workitem = Workitem::all();
            // Project and project id from database
            $test = Project::all()->first();
            $items = Workitem::where('project_id', $test->id)->get();
            // All users where project_id is the current projects id
            $userproject = UserProject::where('project_id', $test->id)->get('user_id');
            // All users whereIn id = $userproject
            $users = User::whereIn('id', $userproject)->get();
            return view('workitems', compact('workitem', 'items', 'userproject', 'users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    //index and direct functions fused (check routes)
    public function direct (Request $request)
    {
        //Show users from current project
        $id = $request->id;
        $project = Project::where('id', $id)->first();

        // Retrieve data from the database
        $workitem = Workitem::all();
        // Project and project id from database
        $test = Project::where('id', $id)->first();
        $items = Workitem::where('project_id', $test->id)->get();
        // All users where project_id is the current projects id
        $userproject = UserProject::where('project_id', $test->id)->get('user_id');
        // All users whereIn id = $userproject
        $users = User::whereIn('id', $userproject)->get();

        return view('workitems', compact('id','project', 'workitem', 'items', 'userproject', 'users'));

    }

    /**
     * Insert workitems into the table
     */
    public function insert(Request $request)
    {
        $assigned_name = User::where('id', $request->assigned_to)->first();
        $workitem = new Workitem;
        $workitem->title = $request->title;
        $workitem->type = $request->type;
        $workitem->effort = $request->effort;
        $workitem->status = $request->status;
        $workitem->assigned_name = $assigned_name->name;
        $workitem->assigned_to = $request->assigned_to;
        $workitem->project_id = $request->project_id;
        $workitem->save();

        return redirect()->route('workitems', [$request->project_id]);
    }
}
