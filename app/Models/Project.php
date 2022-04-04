<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function addList(string $name)
    {
        $list = new TaskList();
        $list->name = $name;
        $list->save();
    }

    public function assignUser(int $user_id, bool $is_admin = false): AssignedUser
    {
        $assignedUser = new AssignedUser();
        $assignedUser->project_id = $this->id;
        $assignedUser->user_id = $user_id;
        $assignedUser->is_admin = $is_admin;
        $assignedUser->save();
        return $assignedUser;
    }

    public function lists()
    {
        return $this->hasMany(TaskList::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'assigned_users');
    }
}
