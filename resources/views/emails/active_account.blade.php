<!DOCTYPE html>
<html>
<head>
    <title>RT-Blogs active account</title>
</head>
<body>
    <h2>Hello {{ $mailData['name'] }}</h2>
    <p>
        <a href="{{ route('register.verified', ['token'=>$mailData['token'], 'register'=>$mailData['id']]) }}">
            Active account
        </a>
    </p>
</body>
</html>
