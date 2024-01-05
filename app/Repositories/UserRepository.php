<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Collection as SupportCollection;

class UserRepository
{
    public function register(array $request): User
    {
        $token = Str::random(20);
        $sendMailVerify = now()->format('Y-m-d H:i:s');
        $userInfo = [
            'token' => $token,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'send_mail_verify' => $sendMailVerify,
        ];
        return User::create($userInfo);
    }

    public function verified(User $request): bool
    {
        $mailVerifyAt = now()->format('Y-m-d H:i:s');
        return User::where('id', $request->id)->update(['status' => User::STATUS_VERIFIED, 'mail_verify_at' => $mailVerifyAt]);
    }

    public function getUserByNameOrEmail(string $request): User | null
    {
        return User::where('email', $request)->orWhere('name', $request)->first();
    }

    public function updateMailVerifyAt(User $user, string $sendMailVerify): bool
    {
        return User::where('id', $user->id)->update(['send_mail_verify' => $sendMailVerify]);
    }

    public function update(int $id, array $request): bool
    {
        return User::findOrFail($id)->update($request);
    }

    public function getList(array $request): LengthAwarePaginator
    {
        $builder = User::where('role', User::USER_ROLE);
        if (data_get($request, 'query')) {
            $builder->where('name', 'like', '%' . $request['query'] . '%');
        }
        return $builder->paginate(config('constant.paginate'));
    }

    public function getUserById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function getUserByMonth(): SupportCollection
    {
        $usersByMonth = User::selectRaw("count(id) as total, DATE_FORMAT(created_at, '%m-%Y') as dates")
            ->groupBy('dates')
            ->orderBy('dates', 'asc')
            ->get();
        $data = $usersByMonth->mapWithKeys(function ($item) {
            return [$item->dates => $item->total];
        });
        return $data;
    }
}
