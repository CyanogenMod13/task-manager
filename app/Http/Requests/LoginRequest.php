<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string email
 * @property string password
 */
class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'email|required',
            'password' => 'string|min:8|required'
        ];
    }
}
