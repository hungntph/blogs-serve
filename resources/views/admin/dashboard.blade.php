@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="main-content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <span>{{ __('message.blogs-by-month') }}</span>
                <canvas id="blogChart" data={{ $blogs }}></canvas>
            </div>
            <div class="col-md-6">
                <span>{{ __('message.users-by-month') }}</span>
                <canvas id="userChart" data={{ $users }}></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('jquery/jquery3.7.1.js') }}"></script>
<script src="{{ asset('jquery/chart.js') }}"></script>
<script src="{{ Vite::asset('resources/js/ajax/dashboard.js') }}"></script>

@endsection
