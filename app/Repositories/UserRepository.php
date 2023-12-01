<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
{
    const MODEL = User::class;

    public function register($request)
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
}
