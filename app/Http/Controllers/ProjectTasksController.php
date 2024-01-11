<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function index()
    {}

    public function store(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        // validate
        $attributes = request()->validate([
            'body' => 'required',
        ]);

        // persist
        $project->addTask(request('body'));

        // redirect
        return redirect($project->path());
    }
}
