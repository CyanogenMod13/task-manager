<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $with = [
        'lists.tasks', 'users'
    ];

    protected $fillable = [
        'name'
    ];

    public function addList(string $name): void
    {
        $list = new TaskList();
        $list->name = $name;
        $list->save();
    }

    public function assignUser(User $user, Role $role): AssignedUser
    {
        return AssignedUser::where(['project_id' => $this->id, 'user_id' => $user->id])
            ->updateOrCreate(['project_id' => $this->id, 'user_id' => $user->id, 'role_id' => $role->id]);
    }

    public function removeUser(User $user): bool
    {
        return AssignedUser::where(['project_id' => $this->id, 'user_id' => $user->id])->delete();
    }

    public function getUserRole(User $user): Role
    {
        return AssignedUser::where(['project_id' => $this->id, 'user_id' => $user->id])
            ->with('role')
            ->first()
            ->role;
    }

    public function lists(): HasMany
    {
        return $this->hasMany(TaskList::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assigned_users');
    }
}
