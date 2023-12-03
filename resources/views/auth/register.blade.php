<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href=" {{asset('css/main.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
</head>
<body>
    <div class="regit">
        <div class="regit-logo">
            <img src="/image/logo-regit.png">
            <span>RT-Blogs</span>
        </div>
    </div>
    <div class="form">
        <div class="form-signup">
            @if(Session::has('success'))
                <div>
                    {{ __('message.register-success') }}
                </div>
            @endif
            @if(Session::has('fail'))
                <div>
                {{ __('message.register-fail') }}
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <p>Sign up</p>
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
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
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
</body>
</html>
