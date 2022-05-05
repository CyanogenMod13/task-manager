<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 * @property integer project_id
 */
class TaskListRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'string|required',
            'project_id' => ['integer', 'exists:tasks,id']
        ];
        if ($this->isMethod('POST')) {
            $rules['project_id'][] = 'required';
        }
        return $rules;
    }
}
