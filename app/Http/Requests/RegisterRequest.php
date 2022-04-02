<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public static function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|min:8|required'
        ];
    }
}
