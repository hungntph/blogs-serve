<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AuthController extends Controller
{

    protected $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerUser(RegisterUserRequest $request)
    {
        try {
            $register = $this->userService->register($request->all());
            if (!$register) {
                return back()->with('fail', 'Register Failed');
            }
            Mail::send('emails.active_account', compact('register'), function ($email) use ($register) {
                $email->subject('RT-Blogs active account');
                $email->to($register['email'], $register['name']);
            });
            return back()->with('success', 'Register successfully! Please check email to active account!');
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function verified(User $register, $token)
    {
        try {
            if ($register->token === $token) {
                $this->userService->verified($register);
                return redirect()->route('login');
            } else {
                return redirect()->route('verify-failed');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
