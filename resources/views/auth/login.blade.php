@extends('layouts.master')

@section('content')

@include('layouts.logo')
<div class="form">
    <div class="form-signup">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <p>{{ __('message.signin') }}</p>
            <div class="form-signup-input">
                <label for="name"><b>{{ __('message.user-or-email') }}</b><span>*</span></label>
                <input type="text" name="email" id="email"> 
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
                @if(Session::has('login-failed'))
                    <span class="text-sm text-red-500">
                        {{ __('message.login-failed') }}
                    </span>
                @endif
            </div>
            <div class="form-signup-input">
                <label for="password"><b>{{ __('message.password') }}</b><span>*</span></label>
                <input type="password" name="password" id="password">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="form-signup-help">
                <div class="form-signup-help-remember">
                    <input type="checkbox" name="remember">
                    <label for="check">{{ __('message.remember-password') }}</label>
                </div>
                <div class="form-signup-help-forgot">
                    <a href="">{{ __('message.forgot-password') }}</a>
                </div>
            </div>
            <div class="form-signup-btn">
                <button type="submit" class="register">{{ __('message.login') }}</button>
            </div>
        </form>
    </div>
</div>
<div class="account-login">
    <a href="">{{ __('message.register-acount') }}</a>
</div>
@endsection
