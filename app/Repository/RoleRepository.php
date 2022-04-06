<?php

namespace App\Repository;

use App\Models\Role;

class RoleRepository
{
    public function find(int $id)
    {
        return Role::findOrFail($id);
    }

    /**
     * @return Role[]
     */
    public function findAll(): array
    {
        return Role::all()->toArray();
    }

    public function findByType(string $type):Role
    {
        return Role::where(['type' => $type])->firstOrFail();
    }
}
