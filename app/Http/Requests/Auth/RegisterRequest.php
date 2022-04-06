<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 * @property string email
 * @property string password
 */
class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|min:8|required'
        ];
    }
}
