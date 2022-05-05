<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title', 'context', 'user'
    ];
}
