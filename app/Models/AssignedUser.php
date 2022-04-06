<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Role|null role
 */
class AssignedUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'project_id', 'user_id', 'role_id'
    ];

    public function isAdmin()
    {
        return $this->role && $this->role->isAdmin();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
