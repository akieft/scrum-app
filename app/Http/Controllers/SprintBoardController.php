<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Workitem;
use Illuminate\Http\Request;

class SprintBoardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //Retrieve data from the database
        $backlog = Workitem::where('type', 'backlog')->get();
        return view('sprintboard', compact('backlog'));
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
        $news = Workitem::where('project_id', $id)->where('type', 'task')->where('status', 'new')->get();
        $todos = Workitem::where('project_id', $id)->where('type', 'task')->where('status', 'to-do')->get();
        $progresses = Workitem::where('project_id', $id)->where('type', 'task')->where('status', 'doing')->get();
        $dones = Workitem::where('project_id', $id)->where('type', 'task')->where('status', 'done')->get();

        $x = 1;

        return view('sprintboard', compact('id','project', 'news', 'todos', 'progresses', 'dones', 'x'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Request $request)
    {
        // variable modelname = new modelname
        $board = Workitem::find($request->workitem_id);
        // Variable modelname->row name in database table
        $board->status = $request->status;
        $board->save();

        return redirect()->route('sprintboard', [$request->project]);
    }

}
