<!DOCTYPE html>
<html>
<head>
    <title>RT-Blogs active account</title>
</head>
<body>
    <h2>Hello {{ $register['name'] }}</h2>
    <p>
        <a href="{{ route('register.verified', ['token'=>$register['token'], 'register'=>$register['id']]) }}">
            Active account
        </a>
    </p>
</body>
</html>
