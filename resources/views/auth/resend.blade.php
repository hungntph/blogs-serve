@extends('layouts.master')

@section('content')

@include('layouts.logo')

<div class="form">
    <div class="form-signup">
        <form action="{{ route('resend') }}" method="POST">
            @csrf
            @if(Session::has('resend-success'))
                <div>
                    {{ __('message.resend-mail-success') }}
                </div>
            @endif
            @if(Session::has('resend-failed'))
                <div>
                    {{ __('message.resend-failed') }}
                </div>
            @endif
            <p>{{ __('message.enter-email') }}</p>
            <div class="form-signup-input">
                <label for="name"><b>{{ __('message.email') }}</b><span>*</span></label>
                <input type="text" name="email" id="email"> 
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="form-signup-btn">
                <button type="submit" class="register">{{ __('message.send-email') }}</button>
            </div>
        </form>
    </div>
</div>
<div class="account-login">
    <a href="{{ route('register.index') }}">{{ __('message.register-acount') }}</a>
</div>

@endsection
