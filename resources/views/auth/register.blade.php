@extends('layouts.master')

@section('content')

@include('layouts.logo')
<div class="form">
    <div class="form-signup">
        @if(Session::has('success'))
            <div>
                {{ trans('message.register-success') }}
            </div>
        @endif
        @if(Session::has('fail'))
            <div>
            {{ trans('message.register-fail') }}
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <p> {{ __('message.signup') }} </p>
            <div class="form-signup-input">
                <label for="name"><b>{{ __('message.name') }}</b><span>*</span></label>
                <input type="text" name="name" id="name" required> 
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="form-signup-input">
                <label for="email"><b>{{ __('message.email') }}</b><span>*</span></label>
                <input type="text" name="email" id="email" required>
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror   
            </div>
            <div class="form-signup-input">
                <label for="password"><b>{{ __('message.password') }}</b><span>*</span></label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="form-signup-input">
                <label for="password-confirm"><b>{{ __('message.password-confirm') }}</b><span>*</span></label>
                <input type="password" name="password_confirmation" id="passwordConfirmation" required>
                @error('password_confirmation')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror   
            </div>
            <div class="form-signup-btn">
                <button type="submit" class="register">{{ __('message.login') }}</button>
            </div>
        </form>
    </div>
</div>
<div class="account-login">
    <a href="">{{ __('message.login-acount') }}</a>
</div>
@endsection