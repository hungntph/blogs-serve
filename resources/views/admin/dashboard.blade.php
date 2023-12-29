@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <canvas id="blogChart" data={{ $data }}></canvas>
        </div>
    </div>
</div>
@endsection
