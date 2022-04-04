<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedUser extends Model
{
    public $timestamps = false;

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
