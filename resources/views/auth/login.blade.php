@extends('layouts.master')

@section('content')

@include('layouts.logo')
<div class="form">
    <div class="form-signup">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @if(Session::has('email-password-incorrect'))
                <span class="text-sm text-red-500">
                    {{ Session::get('email-password-incorrect') }}
                </span>
            @endif
            @if(Session::has('blocked'))
                <span class="text-sm text-red-500">
                    {{ Session::get('blocked') }}
                </span>
            @endif
            <p>{{ __('message.signin') }}</p>
            <div class="form-signup-input">
                <label for="name"><b>{{ __('message.user-or-email') }}</b><span>*</span></label>
                <input type="text" name="email" id="email"> 
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
                @if(Session::has('username-email-incorrect'))
                    <span class="text-sm text-red-500">
                        {{ __('message.username-email-incorrect') }}
                    </span>
                @endif
            </div>
            <div class="form-signup-input">
                <label for="password"><b>{{ __('message.password') }}</b><span>*</span></label>
                <input type="password" name="password" id="password">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
                @if(Session::has('password-incorrect'))
                    <span class="text-sm text-red-500">
                        {{ __('message.password-incorrect') }}
                    </span>
                @endif
            </div>
            <div class="form-signup-help">
                <div class="form-signup-help-remember">
                    <input type="checkbox" name="remember">
                    <label for="check">{{ __('message.remember-password') }}</label>
                </div>
                <div class="form-signup-help-forgot">
                    <a href="{{ route('reset.index') }}">{{ __('message.forgot-password') }}</a>
                </div>
            </div>
            <div class="form-signup-btn">
                <button type="submit" class="register">{{ __('message.login') }}</button>
            </div>
        </form>
    </div>
</div>
<div class="account-login">
    <a href="{{ route('register.index') }}">{{ __('message.register-acount') }}</a>
</div>
@endsection
