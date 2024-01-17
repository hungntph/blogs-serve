@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="main-content">
    <div class="main-content-statistical">
        <form action="{{ route('admin.index') }}" method="GET">
            <span>{{ __('message.order-by-year') }}</span>
            <select class="blogs-title-category" name="year" id="year" onchange="this.form.submit()">
                @foreach ($years as $key => $value)
                <option value="{{ $value['year'] }}" {{ $value['year'] == request()->input('year') ? 'selected' : '' }}>
                    {{ $value['year'] }}
                </option>
                @endforeach
            </select>
        </form>
        <div class="main-content-statistical-user">
            <span><i class="fa-solid fa-users"></i></span>
            <span>{{ $users['total'] }}</span>
        </div>
        <div class="main-content-statistical-blog">
            <span><i class="fa-solid fa-blog"></i></span>
            <span>{{ $blogs['total'] }}</span>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <span>{{ __('message.blogs-by-month') }}</span>
                <canvas id="blogChart" data={{ $blogs['data'] }}></canvas>
            </div>
            <div class="col-md-6">
                <span>{{ __('message.users-by-month') }}</span>
                <canvas id="userChart" data={{ $users['data'] }}></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('jquery/jquery3.7.1.js') }}"></script>
<script src="{{ asset('jquery/chart.js') }}"></script>
<script src="{{ Vite::asset('resources/js/ajax/dashboard.js') }}"></script>

@endsection
