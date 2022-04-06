<?php

namespace App\Http\Requests\Project;

/**
 * @property string name
 */
class TaskListRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required'
        ];
    }
}
