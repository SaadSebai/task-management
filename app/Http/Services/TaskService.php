<?php

namespace App\Http\Services;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function getList(Project $project): Collection
    {
        return $project->tasks()->orderBy('priority')->get();
    }

    public function create(Project $project, array $data): Task
    {
        $last_priority = $project->tasks()->latest()->first(['priority'])?->priority + 1;

        return $project->tasks()->create($data + ['priority' => $last_priority]);
    }

    public function update(Project $project, Task $task, array $data): Task
    {
        DB::beginTransaction();

        $old_priority = $task->priority;

        $task->update($data);

        if (isset($data['priority']) && $data['priority'] != $old_priority)
        {
            $this->orderPriorities(
                project: $project,
                task_id: $task->id,
                old_priority: $old_priority,
                new_priority: $task->priority
            );
        }

        DB::commit();

        return $task;
    }

    public function delete(Project $project, Task $task): Task
    {
        DB::beginTransaction();

        $task->delete();

        $project->tasks()
            ->where('priority', '>=', $task->priority)
            ->decrement('priority');

        DB::commit();

        return $task;
    }

    /**
     * Update the priority of tasks with priority between old_priority and new_priority
     *
     * @param  Project  $project
     * @param  int  $task_id
     * @param  int  $old_priority
     * @param  int  $new_priority
     *
     * @return void
     */
    private function orderPriorities(Project $project, int $task_id, int $old_priority, int $new_priority): void
    {
        $project->tasks()
            ->whereNot('id', $task_id)
            ->priorityRange($new_priority, $old_priority)
            ->when(
                $new_priority >= $old_priority,
                fn (Builder $query) => $query->decrement('priority'),
                fn (Builder $query) => $query->increment('priority')
            );
    }
}
