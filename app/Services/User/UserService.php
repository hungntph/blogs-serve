<?php
namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService
{

    public $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register($request): User
    {
        return $this->userRepository->register($request);
    }

    public function verified(): bool
    {
        $request = User::STATUS_VERIFIED;
        return $this->userRepository->verified($request);
    }
}
