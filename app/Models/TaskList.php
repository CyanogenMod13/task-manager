<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    public function addTask(string $name)
    {
        $task = new Task();
        $task->name = $name;
        $task->save();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
