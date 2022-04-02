<?php

namespace App\Models;

enum UserRole: string
{
    case ADMIN_ROLE = 'ADMIN_ROLE';
    case MANAGER_ROLE = 'MANAGER_ROLE';
    case TEAMMATE_ROLE = 'TEAMMATE_ROLE';

    public function containsPermission(UserPermission $permission): bool
    {
        return !is_null(match ($this)
        {
            self::ADMIN_ROLE => array_search($permission, [
                UserPermission::PROJECT_ASSIGN_USER,
                UserPermission::PROJECT_DELETE,
                UserPermission::PROJECT_UPDATE
            ]),
            self::MANAGER_ROLE => array_search($permission, [
                UserPermission::PROJECT_ASSIGN_USER
            ]),
            self::TEAMMATE_ROLE => null,
        });
    }
}
