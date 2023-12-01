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
    <div class="register">
        <div class="register-logo">
            <img src="/image/logo-regit.png">
            <span>RT-Blogs</span>
        </div>
    </div>
    <div class="form">
        <div class="form-signup">
            @if(Session::has('success'))
                <div>
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('fail'))
                <div>
                    {{ Session::get('fail') }}
                </div>
            @endif
            <p>Sign up</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <label for="name"><b>Username</b><span>*</span></label>
                <input type="text" name="name" id="name" required>
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror

                <label for="email"><b>Email</b><span>*</span></label>
                <input type="text" name="email" id="email" required>
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror

                <label for="password"><b>Password</b><span>*</span></label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror

                <label for="password-re"><b>Password confirm</b><span>*</span></label>
                <input type="password" name="password-confirm" id="password-confirm" required>
                @error('password-confirm')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror

                <button type="submit" class="register">Sign up</button>
            </form>
        </div>
    </div>
    <div class="account-login">
        <a href="">Already have an account? Login</a>
    </div>
</body>
</html>