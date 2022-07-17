<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserLoginWithEmailRequest;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use App\Data\UserData;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Регистрация пользователя
     *
     * @param  \App\Http\Requests\Users\UserRegisterRequest  $request
     * @param  \App\Services\UserService  $service
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request, UserService $service)
    {
        $data = $request->validated();

        $createdUser = $service->register($data);

        return response($createdUser, 201);
    }

    /**
     * Авторизация пользователя
     *
     * @param  \App\Http\Requests\Users\UserLoginWithEmailRequest  $request
     * @param  \App\Services\UserService  $service
     * @return \Illuminate\Http\Response
     */
    public function loginWithEmail(UserLoginWithEmailRequest $request, UserService $service)
    {
        $data = UserData::fromRequest($request);

        $user = $service->loginWithEmail($data);

        return response($user, 200);
    }
}
