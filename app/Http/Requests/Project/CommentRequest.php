<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string content
 */
class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'content' => 'required|string'
        ];
    }
}
