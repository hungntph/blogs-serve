<?php
namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginUserRequest;
use App\Mail\SendMailResetPassword;
use App\Models\Blog;
use App\Repositories\ResetPasswordRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        public UserRepository $userRepository,
        public ResetPasswordRepository $resetPasswordRepository
    ) {
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
                $sendMailVerify = now()->format('Y-m-d H:i:s');
                $updateMailVerifyAt = $this->userRepository->updateMailVerifyAt($user, $sendMailVerify);
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

    public function sendMailResetPassword(array $request): bool
    {
        try {
            $token = $this->generateToken($request['email']);
            if ($token) {
                $user = $this->userRepository->getUserByNameOrEmail($request['email']);
                if ($user) {
                    Mail::to($user['email'])->send(new SendMailResetPassword($user, $token));
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function generateToken($email)
    {
        $passwordReset = $this->resetPasswordRepository->create($email);
        return $passwordReset->token;
    }

    public function reseted(array $request): bool
    {
        try {
            $passwordReset = $this->resetPasswordRepository->findByToken($request['token']);
            $timenow = now();
            $diff = $timenow->diffInMinutes(Carbon::parse($passwordReset->updated_at));
            if ($diff < config('constant.expire_time')) {
                $passwordReset->delete();
                $user = $this->userRepository->getUserByNameOrEmail($passwordReset->email);
                $user->update([
                    'password' => Hash::make($request['password']),
                ]);
                return true;
            }
            $passwordReset->delete();
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function toggleLike(array $request): array
    {
        try {
            $blogId = $request['blog_id'];
            $user = auth()->user();
            $checkLike = $user->likes()->where('blog_id', $blogId)->exists();
            if ($checkLike) {
                $user->likes()->detach($blogId);
            } else {
                $user->likes()->attach($blogId);
            }
            $totalLike = Blog::with('likes')->findOrFail($blogId);
            return [
                'checkLike' => $checkLike,
                'total' => $totalLike->likes->count(),
            ];
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function updateProfile(int $id, array $request): bool
    {
        try {
            return $this->userRepository->update($id, $request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function changePassword(int $id, array $request): bool
    {
        try {
            $newPassword = [
                'password' => Hash::make($request['password']),
            ];
            return $this->userRepository->update($id, $newPassword);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserList(array $request): LengthAwarePaginator
    {
        try {
            return $this->userRepository->getList($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function toggleBlockUser(int $id): bool
    {
        try {
            $user = $this->userRepository->getUserById($id);
            $verifyAt = $user->mail_verify_at;
            if ($user->status != User::STATUS_BLOCKED) {
                $newStatus = [
                    'status' => User::STATUS_BLOCKED,
                ];
            } else {
                $newStatus = [
                    'status' => $verifyAt ? User::STATUS_VERIFIED : User::STATUS_NOT_VERIFIED,
                ];
            }
            return $this->userRepository->update($id, $newStatus);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
