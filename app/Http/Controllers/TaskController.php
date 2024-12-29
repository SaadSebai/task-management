<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Project;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Project $project, TaskService $service)
    {
        $tasks = $service->getList($project);

        return Inertia::render('Tasks/Index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return Inertia::render('Tasks/Create', compact('project'));
    }

    public function store(StoreTaskRequest $request, Project $project, TaskService $service)
    {
        $service->create(project: $project, data: $request->validated());

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task)
    {
        return Inertia::render('Tasks/Edit', compact('project', 'task'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task, TaskService $service)
    {
        $service->update(project: $project, task: $task, data: $request->validated());

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task, TaskService $service)
    {
        $service->delete(project: $project, task: $task);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task deleted successfully.');
    }
}
