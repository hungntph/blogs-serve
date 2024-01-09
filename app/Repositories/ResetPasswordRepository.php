<?php

namespace App\Repositories;

use App\Models\ResetPassword;
use Illuminate\Support\Str;

class ResetPasswordRepository
{
    public function create(string $email): ResetPassword
    {
        $data = [
            'email' => $email,
            'token' => Str::random(60),
        ];
        return ResetPassword::create($data);
    }

    public function findByToken(string $token): ResetPassword | null
    {
        return ResetPassword::where('token', $token)->first();
    }
}
