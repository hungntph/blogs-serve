@extends('layouts.master')

@section('content')

@include('layouts.logo')

<div class="form">
    <div class="form-signup">
        <form action="{{ route('reset.send') }}" method="POST">
            @csrf
            @if(Session::has('send-reset-success'))
                <span class="text-success">
                    {{ __('message.resend-mail-success') }}
                </span>
            @endif
            @if(Session::has('email-incorrect'))
                <span class="text-danger">
                    {{ __('message.mail-incorrect') }}
                </span>
            @endif
            <p>{{ __('message.email') }}</p>
            <div class="form-signup-input">
                <label for="name"><b>{{ __('message.email') }}</b><span>*</span></label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"> 
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
