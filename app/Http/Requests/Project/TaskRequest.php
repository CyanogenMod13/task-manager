<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string name
 * @property string description
 * @property string start
 * @property string end
 * @property string priority
 * @property integer task_list_id
 * @property integer executor_id
 */
class TaskRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'description' => 'string',
            'start' => 'date',
            'end' => 'date',
            'priority' => [Rule::in(['low', 'normal', 'high', 'critical'])],
            'executor_id' => 'integer|exists:user',
            'name' => ['string'],
            'task_list_id' => ['integer', 'exists:task_lists,id']
        ];
        if ($this->isMethod('POST')) {
            $rules['name'][] = 'required';
            $rules['task_list_id'][] = 'required';
        }
        return $rules;
    }
}
