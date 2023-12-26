@extends('layouts.master')

@section('content')

@include('layouts.navbar')

@include('layouts.logo')

<div class="form">
    <div class="form-signup">
        <form action="{{ route('update.password', $auth->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if(Session::has('change-password-success'))
                <span class="text-sm text-red-500">
                    {{ __('message.change-password-success') }}
                </span>
            @endif
            @if(Session::has('change-password-failed'))
                <span class="text-sm text-red-500">
                    {{ __('message.change-password-failed') }}
                </span>
            @endif
            @if(Session::has('old-password-incorrect'))
                <span class="text-sm text-red-500">
                    {{ __('message.old-password-incorrect') }}
                </span>
            @endif
            <div class="form-signup-input">
                <label for="password"><b>{{ __('message.old-password') }}</b><span>*</span></label>
                <input type="password" name="old-password" id="oldPassword" required>
                @error('old-password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="form-signup-input">
                <label for="password"><b>{{ __('message.new-password') }}</b><span>*</span></label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="form-signup-input">
                <label for="password-confirm"><b>{{ __('message.confirm-new-password') }}</b><span>*</span></label>
                <input type="password" name="password_confirmation" id="passwordConfirmation" required>
                @error('password_confirmation')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror   
            </div>
            <div class="form-signup-btn">
                <button type="submit" class="register">{{ __('message.save') }}</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

@endsection
