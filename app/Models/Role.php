<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';

    protected $table = 'roles';

    public $timestamps = false;

    public function isAdmin(): bool
    {
        return $this->type === self::ADMIN_ROLE;
    }
}
