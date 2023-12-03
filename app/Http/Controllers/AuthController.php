<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{

    public $userService;

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
            DB::beginTransaction();
            $register = $this->userService->register($request->only('name', 'email', 'password'));
            if (!$register) {
                return back()->with('fail', '');
            }
            Mail::to($register['email'])->send(new SendMail($register));
            DB::commit();
            return back()->with('success', '');
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function verified(User $register, $token): RedirectResponse
    {
        try {
            if ($register->token === $token) {
                $verified = $this->userService->verified($register);
                if ($verified === true) {
                    return redirect()->intended('auth.login');
                }
            } else {
                return redirect()->intended('verify-failed');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
