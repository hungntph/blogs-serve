<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{

    public UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function register(): View
    {
        return view("auth.register");
    }

    public function login(): View
    {
        return view("auth.login");
    }

    public function registerUser(RegisterUserRequest $request): RedirectResponse
    {
        try {
            $register = $this->userService->register($request->only('name', 'email', 'password'));
            if (!$register) {
                return back()->with('fail', trans('message.register-faild'));
            }
            Mail::to($register['email'])->send(new SendMail($register));
            return back()->with('success', trans('message.register-success'));
        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }
    }

    public function verified(User $register, string $token): RedirectResponse
    {
        try {
            if ($register->token === $token) {
                $verified = $this->userService->verified($register);
                if ($verified) {
                    return redirect()->route('auth.login');
                }
            } else {
                return redirect()->route('verify-failed')->with('errors', trans('message.verify-failed'));
            }
        } catch (\Exception $e) {
            return redirect()->route('verify-failed')->with('errors', $e->getMessage());
        }
    }
}
