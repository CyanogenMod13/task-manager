<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'project_id', 'user_id', 'is_admin'
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
