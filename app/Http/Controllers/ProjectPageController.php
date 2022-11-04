<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use App\Models\Workitem;
use Illuminate\Http\Request;

class ProjectPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Show users in project
        $project = Project::all()->first();
        $guests = User::all();

        //Grab members from current project
        $test = Project::all()->first();
        $users = UserProject::where('project_id', $test->id)->get('user_id');
        $members = User::whereIn('id', $users)->get();

        //View count made workitems
        $count = Workitem::where('project_id', $test->id)->count();
        //View count completed workitems
        $completed = Workitem::where('project_id', $test->id)->where('status', 'done')->count();

        return view('projectpage', compact('members', 'test', 'count', 'completed', 'project', 'guests'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function direct(Request $request)
    {
        //Show users in project
        $guests = User::all();
        $id = $request->id;
        $project = Project::where('id', $id)->first();

        //Grab all users from current project
        $users = UserProject::where('project_id', $id)->get('user_id');
        $members = User::whereIn('id', $users)->get();

        //View count made workitems
        $count = Workitem::where('project_id', $id)->count();
        //View count completed workitems
        $completed = Workitem::where('project_id', $id)->where('status', 'done')->count();

        return view('/projectpage', compact('id', 'members', 'count', 'completed', 'guests', 'project'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $preset = UserProject::where('user_id', $request->id)->where('project_id', $request->project)->first();
        if(UserProject::where('user_id', $request->id)->where('project_id', $request->project)->count() <= 0){
            $userproject = new UserProject;
            $userproject->user_id = $request->id;
            $userproject->project_id = $request->project;
            $userproject->save();
            return redirect('projectpage/{id}');
        } else {
            return redirect('projectpage/{id}');
        }
    }
}
