<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public static function rules()
    {
        return [
            'name' => 'string|required'
        ];
    }
}
