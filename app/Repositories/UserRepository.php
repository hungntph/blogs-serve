<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function register(array $request): User
    {
        $token = Str::random(20);
        $mailVerifyAt = now()->format('Y-m-d H:i:s');
        $userInfo = [
            'token' => $token,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'mail_verify_at' => $mailVerifyAt,
        ];
        return User::create($userInfo);
    }

    public function verified(User $request): bool
    {
        return User::where('id', $request->id)->update(['status' => User::STATUS_VERIFIED]);
    }

    public function getUserByNameOrEmail(string $request): User | null
    {
        return User::where('email', $request)->orWhere('name', $request)->first();
    }

    public function updateMailVerifyAt(User $user, string $mailVerifyAt): bool
    {
        return User::where('id', $user->id)->update(['mail_verify_at' => $mailVerifyAt]);
    }

    public function update(int $id, array $request): bool
    {
        return User::findOrFail($id)->update($request);
    }
}
