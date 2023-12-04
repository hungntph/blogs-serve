<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    const MODEL = User::class;

    public function register(array $request): User
    {
        $token = Str::random(20);
        $userInfo = [
            'token' => $token,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];
        return User::create($userInfo);
    }

    public function verified(User $request): bool
    {
        return User::where('id', $request->id)->update(['status' => User::STATUS_VERIFIED]);
    }
}
