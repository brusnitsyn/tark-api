<?php

namespace App\Data;

use App\Casts\ObjectData;
use Carbon\Carbon;
use Illuminate\Http\Request;

final class UserData extends ObjectData
{
    public ?int $id;
    public ?string $name;
    public string $email;
    public ?Carbon $email_verified_at;
    public ?string $call;
    public ?string $password;

    public static function fromRequest(
        Request $request
    ): UserData {
        return new UserData(
            email: $request->get('email'),
            password: $request->get('password'),
        );
    }
}
