<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int user_id
 * @property bool is_admin
 */
class ProjectAssignUserRequest extends FormRequest
{
    public static function rules()
    {
        return [
            'user_id' => 'integer|required|exists:users,id',
            'is_admin' => 'boolean'
        ];
    }
}
