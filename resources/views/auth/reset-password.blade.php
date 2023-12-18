@extends('layouts.master')

@section('content')

@include('layouts.logo')

<div class="form">
    <div class="form-signup">
        <form action="{{ route('reset.password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
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
                <button type="submit" class="register">{{ __('message.save') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
