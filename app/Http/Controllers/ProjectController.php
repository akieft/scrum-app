<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $users = User::all();
            $userprojects = UserProject::where('user_id', Auth::id())->get('project_id');
            $projectusers = UserProject::where('user_id', Auth::id())->get('user_id');
            $projects = Project::whereIn('id', $userprojects)->get();
            $usernames = User::whereIn('id', $projectusers)->get();
            return view('project', compact('projects', 'user', 'users', 'usernames'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert(Request $request)
    {
        $owner_name = User::where('id', $request->product_owner)->first();
        $scrum_name = User::where('id', $request->scrum_master)->first();
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->end_date = $request->end_date;
        $project->owner_name = $owner_name->name;
        $project->scrum_name = $scrum_name->name;
        $project->product_owner = $request->product_owner;
        $project->scrum_master = $request->scrum_master;
        $project->save();

        $userproject = new UserProject;
        $userproject->user_id = Auth::id();
        $userproject->project_id = $project->id;
        $userproject->save();

        if($project->scrum_master == Auth::id()){

        } else {
            $userproject1 = new UserProject;
            $userproject1->user_id = $project->scrum_master;
            $userproject1->project_id = $project->id;
            $userproject1->save();
        }

        if($project->product_owner == Auth::id() || $project->product_owner == $project->scrum_master){

        } else {
            $userproject2 = new UserProject;
            $userproject2->user_id = $project->product_owner;
            $userproject2->project_id = $project->id;
            $userproject2->save();
        }
        return redirect('/home');
    }
}
