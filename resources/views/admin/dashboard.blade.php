@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="main">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <canvas id="blogChart" data={{ $blogs }}></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="userChart" data={{ $users }}></canvas>
            </div>
        </div>
    </div>
</div>

@endsection
