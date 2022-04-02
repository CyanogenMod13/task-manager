<?php

namespace App\Http\Requests\Project;

use App\Models\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProjectAssignUserRequest extends FormRequest
{
    public static function rules()
    {
        return [
            'user_id' => 'integer|required|exists:users,id',
            'project_id' => 'integer|required|exists:projects,id',
            'role' => [new Enum(UserRole::class)]
        ];
    }
}
