<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public static function rules()
    {
        return [
            'email' => 'email|required',
            'password' => 'string|min:8|required'
        ];
    }
}
