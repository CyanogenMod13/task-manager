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

    public function lists(): HasMany
    {
        return $this->hasMany(TaskList::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assigned_users');
    }
}
