<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register($request)
    {
        return $this->userRepository->register($request);
    }

    public function verified($request)
    {
        $this->userRepository->update($request->id, [], ['status'=> config('constant.user.status.verified')]);
        return true;
    }
}
