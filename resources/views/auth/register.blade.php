@extends('layouts.master')

@section('content')

@include('layouts.logo')
<div class="form">
    <div class="form-signup">
        @if(Session::has('success'))
            <span class="text-success">
                {{ __('message.register-success') }}
            </span>
        @endif
        @if(Session::has('fail'))
            <span class="text-danger">
            {{ __('message.register-fail') }}
            </span>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <p> {{ __('message.signup') }} </p>
            <div class="form-signup-input">
                <label for="name"><b>{{ __('message.name') }}</b><span>*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', request()->input('name')) }}"> 
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="form-signup-input">
                <label for="email"><b>{{ __('message.email') }}</b><span>*</span></label>
                <input type="text" name="email" id="email" value="{{ old('email', request()->input('email')) }}">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror   
            </div>
            <div class="form-signup-input">
                <label for="password"><b>{{ __('message.password') }}</b><span>*</span></label>
                <input type="password" name="password" id="password">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="form-signup-input">
                <label for="password-confirm"><b>{{ __('message.password-confirm') }}</b><span>*</span></label>
                <input type="password" name="password_confirmation" id="passwordConfirmation">
                @error('password_confirmation')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror   
            </div>
            <div class="form-signup-btn">
                <button type="submit" class="register">{{ __('message.signup') }}</button>
            </div>
        </form>
    </div>
</div>
<div class="account-login">
    <a href="{{ route('login.index') }}">{{ __('message.login-acount') }}</a>
</div>
@endsection
