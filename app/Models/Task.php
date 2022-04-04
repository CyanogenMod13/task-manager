<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function assignUser(User $user)
    {
        $this->executor_id = $user->id;
    }

    public function setPriority(TaskPriority $priority)
    {
        $this->priority = $priority->value;
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
}

