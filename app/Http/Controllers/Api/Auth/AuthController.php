<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\UserCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

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
        UserCreatedEvent::dispatch($user);
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
            'access_token' => $token,
            'type' => 'Bearer',
            'expire_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
