<?php

namespace App\Models;

enum TaskPriority: string
{
    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';
    case CRITICAL = 'critical';
}
