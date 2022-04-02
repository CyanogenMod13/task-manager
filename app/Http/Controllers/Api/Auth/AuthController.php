<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $token = auth()->attempt($credentials);
        if (!$token)
            throw new AuthenticationException();
        return $this->sendToken($token);
    }

    /**
     * @throws AuthenticationException
     */
    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $user = new User($credentials);
        $user->password = bcrypt($credentials['password']);
        $user->save();
        $token = auth()->login($user);
        if (!$token)
            throw new AuthenticationException();
        return $this->sendToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    private function sendToken(string $token)
    {
        return [
            'token' => $token,
            'type' => 'Bearer'
        ];
    }
}
