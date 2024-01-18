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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>

<body>
    <div id="box" data="{{ auth()->user()?->id }}" logout-route="{{ route('logout') }}">

        @yield('content')

        @include('user.block_popup')

    </div>

    <script src="{{ asset('jquery/jquery3.7.1.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/app.js') }}"></script>
    <script type="module" src="{{ Vite::asset('resources/js/ajax/block-message.js') }}"></script>
    <script type="module" src="{{ Vite::asset('resources/js/ajax/delete-blog.js') }}"></script>
    <script type="module" src="{{ Vite::asset('resources/js/ajax/delete-category.js') }}"></script>
    <script type="module" src="{{ Vite::asset('resources/js/connect.js') }}"></script>

    @yield('scripts')
</body>

</html>
