<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 */
class ProjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required'
        ];
    }
}
