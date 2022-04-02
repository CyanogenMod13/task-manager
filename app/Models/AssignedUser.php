<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedUser extends Model
{
    public $timestamps = false;

    public function setRole(UserRole $role)
    {
        $this->role = $role->value;
    }

    public function getRole(): UserRole
    {
        return UserRole::from($this->role);
    }
}
