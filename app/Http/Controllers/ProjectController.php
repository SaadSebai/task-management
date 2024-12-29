<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\UpdateOrStoreProjectRequest;
use App\Http\Services\ProjectService;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(ProjectService $service)
    {
        return Inertia::render('Project/Index', [
            'projects' => $service->getList()
        ]);
    }

    public function create()
    {
        return Inertia::render('Project/Create');
    }

    public function store(UpdateOrStoreProjectRequest $request, ProjectService $service)
    {
        $service->create($request->validated());

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Project/Edit', compact('project'));
    }

    public function update(UpdateOrStoreProjectRequest $request, Project $project, ProjectService $service)
    {
        $service->update(project: $project, data: $request->validated());

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project, ProjectService $service)
    {
        $service->delete($project);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
