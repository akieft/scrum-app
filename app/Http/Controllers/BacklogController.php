<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use App\Models\Workitem;
use Illuminate\Http\Request;

class BacklogController
{
    /**
     * Show the table of backlog
     */
    public function index()
    {
        //Retrieve data from the database
        $backlog = Workitem::where('type', 'backlog')->get();
        return view('backlog', compact('backlog'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function direct (Request $request)
    {
        //Show users of current project
        $id = $request->id;
        $project = Project::where('id', $id)->first();

        //Retrieve data from the database of current project
        $backlog = Workitem::where('type', 'backlog')->where('project_id', $id)->get();
        return view('backlog', compact('id','project', 'backlog'));

    }
}
