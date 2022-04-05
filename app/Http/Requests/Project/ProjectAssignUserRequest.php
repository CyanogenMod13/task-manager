<?php

namespace App\Http\Requests\Project;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int user_id
 * @property bool|null is_admin
 */
class ProjectAssignUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'integer|required|exists:users,id',
            'is_admin' => 'boolean'
        ];
    }
}
