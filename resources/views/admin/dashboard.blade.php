@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<script src="{{ Vite::asset('resources/js/app.js') }}"></script>

@endsection
