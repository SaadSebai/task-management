<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'name',
        'priority'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Select the tasks that are between priority_1 and priority_2.
     * The max() and the min() function will decide which one will be the highest and the lowest.
     *
     * @param  Builder  $query
     * @param  int  $priority_1
     * @param  int  $priority_2
     *
     * @return Builder
     */
    public function scopePriorityRange(Builder $query, int $priority_1, int $priority_2): Builder
    {
        return $query->whereBetween(
            'priority',
            [min($priority_1, $priority_2), max($priority_1, $priority_2)]
        );
    }
}
