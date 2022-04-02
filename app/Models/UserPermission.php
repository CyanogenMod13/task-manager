<?php

namespace App\Models;

enum UserPermission
{
    case PROJECT_UPDATE;
    case PROJECT_DELETE;
    case PROJECT_ASSIGN_USER;
}
