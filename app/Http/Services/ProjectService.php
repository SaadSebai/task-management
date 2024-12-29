<?php

namespace App\Http\Services;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectService
{
    public function getList(): LengthAwarePaginator
    {
        return Project::query()
            ->withCount('tasks')
            ->latest()
            ->paginate();
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project;
    }

    public function delete(Project $project): Project
    {
        $project->delete();

        return $project;
    }
}
