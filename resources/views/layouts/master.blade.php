<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ Vite::asset('resources/css/app.css') }}">
    <title>RT-Blogs</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons-1.11.2/font/bootstrap-icons.min.css') }}">
    <script src="{{ asset('jquery/jquery3.7.1.js') }}"></script>
    <script src="{{ asset('jquery/chart.js') }}"></script>
</head>

<body>
    <div id="box">

        @yield('content')

        @include('user.block_popup')

    </div>

    <script src="{{ Vite::asset('resources/js/app.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/ajax/block-message.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/ajax/dashboard.js') }}"></script>
    <script type="module" src="{{ Vite::asset('resources/js/connect.js') }}"></script>
</body>

</html>
