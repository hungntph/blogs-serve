<?php
namespace App\Services;

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

    public function verified($request): bool
    {
        return $this->userRepository->verified($request);
    }
}
