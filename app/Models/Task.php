<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const PRIORITY_LOW = 'low';
    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';
    public const PRIORITY_CRITICAL = 'critical';

    protected $casts = [
        'end' => 'datetime:Y-m-d H:m',
        'start' => 'datetime:Y-m-d H:m'
    ];

    protected $fillable = [
        'name', 'description', 'start', 'end', 'priority', 'executor_id', 'task_list_id'
    ];

    public function assignUser(User $user)
    {
        $this->executor_id = $user->id;
    }

    public function setPriority(string $priority)
    {
        $this->priority = $priority;
    }

    public function setEstimate(mixed $start, mixed $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function moveToList(TaskList $list)
    {
        $this->list_id = $list->id;
    }

    public function list()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function executor()
    {
        return $this->belongsTo(User::class);
    }
}

