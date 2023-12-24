<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\ResendMailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        public UserService $userService,
        public BlogService $blogService,
        public CategoryService $categoryService
    ) {
    }

    public function register()
    {
        return view("auth.register");
    }

    public function login()
    {
        return view("auth.login");
    }

    public function resendMailVerify()
    {
        return view("auth.resend");
    }

    public function registerUser(RegisterUserRequest $request)
    {
        $register = $this->userService->register($request->only('name', 'email', 'password'));
        if ($register) {
            return back()->with('success', trans('message.register-success'));
        }
        return back()->with('fail', trans('message.register-faild'));
    }

    public function verified(User $user, string $token)
    {
        $timenow = now();
        $diff = $timenow->diffInMinutes(Carbon::parse($user->mail_verify_at));
        if ($diff > config('constant.expire_time')) {
            return redirect()->route('verify-expired')->with('errors', trans('message.verify-expired'));
        }
        if ($user->token === $token) {
            if ($user->status == User::STATUS_VERIFIED) {
                return redirect()->route('login.index');
            }
            $verified = $this->userService->verified($user);
            if ($verified) {
                return redirect()->route('login.index');
            }
        }
        return redirect()->route('verify-failed')->with('errors', trans('message.verify-failed'));
    }

    public function resendMail(ResendMailRequest $request)
    {
        $send = $this->userService->resendMailVerify($request->only('email'));
        if ($send) {
            return back()->with('resend-success', trans('message.resend-mail-success'));
        }
        return back()->with('email-incorrect', trans('message.mail-incorrect'));
    }

    public function loginUser(LoginUserRequest $request)
    {
        $user = $this->userService->login($request);
        if ($user) {
            if ($user->status == User::STATUS_NOT_VERIFIED) {
                return redirect()->route('resend-mail-verify');
            }
            if ($user->status == User::STATUS_BLOCKED) {
                return back()->with('blocked', trans('message.blocked'));
            }
            Auth::login($user, $request['remember'] ? true: false);
            if ($user->role == User::ADMIN_ROLE) {
                return redirect()->route('admin.index');
            }
            return redirect()->route('home');
        }
        return back()->with('email-password-incorrect', trans('message.email-password-incorrect'));
    }

    public function logoutUser()
    {
        $this->userService->logout();
        return redirect()->route('login.index');
    }

    public function resetForm()
    {
        return view("auth.send-reset-password");
    }

    public function sendResetPassword(ResendMailRequest $request)
    {
        $send = $this->userService->sendMailResetPassword($request->only('email'));
        if ($send) {
            return back()->with('send-reset-success', trans('message.send-reset-password-success'));
        }
        return back()->with('email-incorrect', trans('message.mail-incorrect'));
    }

    public function mailResetPassword(string $token)
    {
        return view("auth.reset-password", compact('token'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $reset = $this->userService->reseted($request->only('token', 'password'));
        if ($reset) {
            return redirect()->route('login.index');
        }
        abort(403);
    }
}
