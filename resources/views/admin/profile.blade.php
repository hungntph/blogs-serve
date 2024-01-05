@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

@php
use App\Models\User;
@endphp

<div class="main-content">
    <div class="title">
        <label for="">{{ __('message.update-profile') }}</label>
    </div>
    <div class="profile">
        <div class="profile-info">
            <form action="{{ route('profile.update', $auth->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                @if(Session::has('profile-update-success'))
                <span class="text-success">
                    {{ __('message.profile-update-success') }}
                </span>
                @endif
                @if(Session::has('profile-update-failed'))
                <span class="text-danger">
                    {{ __('message.profile-update-failed') }}
                </span>
                @endif
                <div class="profile-info-image">
                    @if($auth->avatar)
                    <img id="showImage" src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}"/>
                    @else
                    <img id="showImage" src="/image/default-user.png">
                    @endif
                </div>
                <div class="profile-info-upload">
                    <label for="uploadImg" class="">{{ __('message.blog-upload-image') }}</label>
                    <input accept="image/*" onchange="loadFile(event)" type="file" name="file" id="uploadImg" class="form-control-file" hidden>
                </div>
                @error('file')
                <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
                <div class="profile-info-name">
                    <input type="text" name="name" value="{{ old('name', $auth->name) }}">
                </div>
                @error('name')
                <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
                <div class="profile-info-name">
                    <input type="text" name="phone" value="{{ old('phone', $auth->phone) }}">
                </div>
                @error('phone')
                <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
                <div class="profile-info-gender">
                    @foreach(User::GENDER as $key => $gender)
                    <input type="radio" name="gender" value="{{$key}}" {{ old('gender', $auth->gender) == $key ? 'checked' : '' }}> {{ $gender }}
                    @endforeach
                </div>
                <div class="profile-info-btn">
                    <div class="profile-info-btn-save">
                        <button type="submit">{{ __('message.save') }}</button>
                    </div>
                    <div class="profile-info-btn-cancel">
                        <a href="{{ url()->previous() }}">{{ __('message.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
