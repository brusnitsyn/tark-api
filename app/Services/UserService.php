<?php

namespace App\Services;

use App\Models\User;
use App\Data\UserData;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function register($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->call = $data['call'];
        $user->password = Hash::make($data['password']);

        $user->save();

        event(new Registered($user));

        $accessToken = $user->createToken('web')->plainTextToken;

        return [
            'user' => $user,
            'token' => $accessToken,
        ];
    }

    public function loginWithEmail(UserData $data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user) throw ValidationException::withMessages(['email' => 'Пользователь не найден!']);

        $credentials = array();
        $credentials['email'] = $data->email;
        $credentials['password'] = $data->password;

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            return [
                'user' => $user,
            ];
        } else {
            throw ValidationException::withMessages([
                'password' => 'Неверный пароль.'
            ]);
        }
    }
}
