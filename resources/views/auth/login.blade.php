<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
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
</body>
</html>
