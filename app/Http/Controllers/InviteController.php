<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\UserProject;
use App\Models\Workitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller
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
        //makes users available to add to project
        $project = Project::all()->first();
        $guests = User::all();

        //shows all the members in the current project
        $test = Project::all()->first();
        $users = UserProject::where('project_id', $test->id)->get('user_id');
        $members = User::whereIn('id', $users)->get();

        return view('invite/{id}', compact('users', 'project', 'guests', 'members'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function direct(Request $request)
    {
        //Show users of current project
        $guests = User::all();
        $id = $request->id;
        $project = Project::where('id', $id)->first();

        //Retrieve data from the database of current project
        $users = UserProject::where('project_id', $id)->get('user_id');
        $members = User::whereIn('id', $users)->get();

        return view('invite', compact('id', 'members', 'guests', 'project'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    //save members to current project in database
    public function save(Request $request)
    {
        $preset = UserProject::where('user_id', $request->id)->where('project_id', $request->project)->count();
        if($preset == 0){
            $userproject = new UserProject;
            $userproject->user_id = $request->id;
            $userproject->project_id = $request->project;
            $userproject->save();
            return redirect()->route('invite', [$request->project]);
        } else {
            return redirect()->route('invite', [$request->project]);
        }
    }
}
