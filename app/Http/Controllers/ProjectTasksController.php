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
