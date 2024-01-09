<!DOCTYPE html>
<html>
<head>
    <title>RT-Blogs active account</title>
</head>
<body>
    <h2>Hello {{ $mailData['name'] }}</h2>
    <p>
        <a href="{{ route('reset.mail', ['token' => $token]) }}">
            Reset password
        </a>
    </p>
</body>
</html>
