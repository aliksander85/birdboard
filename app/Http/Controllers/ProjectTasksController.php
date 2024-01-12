<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function index()
    {}

    public function store(Project $project)
    {
        $this->authorize('update', $project);

        // validate
        request()->validate([
            'body' => 'required',
        ]);

        // persist
        $project->addTask(request('body'));

        // redirect
        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        request()->validate([
            'body' => 'required',
        ]);

        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed'),
        ]);

        return redirect($project->path());
    }
}
