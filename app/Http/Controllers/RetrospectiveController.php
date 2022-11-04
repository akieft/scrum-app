<?php

namespace App\Http\Controllers;

use App\Models\Retrospective;
use App\Models\Sprint;
use App\Models\SprintReview;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RetrospectiveController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function direct(Request $request)
    {
        //Show users of current project
        $id = $request->id;
        $project = Project::where('id', $id)->first();

        $x = 1;

        //Retrieve data from the database of current project
        $positives = Retrospective::where('project_id', $id)->where('type', 'positive')->get();
        $negatives = Retrospective::where('project_id', $id)->where('type', 'negative')->get();

        return view('retrospective', compact('positives', 'id', 'project', 'negatives', 'x'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        //saving filled in data into database
        $retro = new Retrospective();
        $retro->description = $request->description;
        $retro->type = $request->type;
        $retro->user_id = Auth::id();
        $retro->user_name = Auth::user()->name;
        $retro->project_id = $request->project_id;
        $retro->save();

        return redirect()->route('retrospective', [$request->project_id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        //function for deleting comments
        $trash = Retrospective::find($request->retro_id);
        $trash ->delete();

        return redirect()->route('retrospective', [$request->project_id]);
    }
}
