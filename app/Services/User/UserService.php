<?php
namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginUserRequest;
use Exception;

class UserService
{

    public UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register(array $request): bool
    {
        try {
            $register = $this->userRepository->register($request);
            if ($register) {
                Mail::to($register['email'])->send(new SendMail($register));
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verified(User $request): bool
    {
        try {
            return $this->userRepository->verified($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function resendMailVerify(array $request): bool
    {
        try {
            $user = $this->userRepository->getUserByNameOrEmail($request['email']);
            if ($user) {
                $mailVerifyAt = now()->format('Y-m-d H:i:s');
                $updateMailVerifyAt = $this->userRepository->updateMailVerifyAt($user, $mailVerifyAt);
                if ($updateMailVerifyAt) {
                    Mail::to($user['email'])->send(new SendMail($user));
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login(LoginUserRequest $request): User | null
    {
        try {
            $user = $this->userRepository->getUserByNameOrEmail($request['email']);
            if ($user) {
                if ((Auth::attempt(['email' => $request['email'],'password' => $request['password']]) ||
                    Auth::attempt(['name' => $request['email'],'password' => $request['password']]))) {
                    return $user;
                }
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function logout(): void
    {
        try {
            Auth::logout();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
