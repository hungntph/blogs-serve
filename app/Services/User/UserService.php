<?php
namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService
{

    public UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register(array $request): User
    {
        return $this->userRepository->register($request);
    }

    public function verified(User $request): bool
    {
        return $this->userRepository->verified($request);
    }
}
