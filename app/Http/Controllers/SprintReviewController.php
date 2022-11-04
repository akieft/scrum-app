<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\SprintReview;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SprintReviewController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function direct(Request $request)
    {
        //Shows sprint reviews of current project
        $user = Auth::user();
        $userProjects = UserProject::where('user_id', $user->id)->get('project_id');
        $planning = SprintReview::whereIn('project_id', $userProjects)->get();

        //Project ID
        $id = $request->id;
        $project = Project::where('id', $id)->first();

        return view('sprintreview', compact('planning', 'project', 'id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        //saving filled in data into database
        $sprint = new SprintReview();
        $sprint->name = $request->name;
        $sprint->description = $request->description;
        $sprint->meeting_date = $request->meeting_date;
        $sprint->project_id = $request->project_id;
        $sprint->save();

        return redirect()->route('sprintreview', [$request->project_id]);
    }
}
