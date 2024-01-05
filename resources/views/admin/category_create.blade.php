@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="edit-blog">
    <div class="edit-blog-link">
        <div>
            <a href="{{ route('category-list') }}">{{ __('message.cl-category-list') }}</a> > <span>{{ __('message.create-category') }}</span>
        </div>
    </div>
    <div class="create-blog-form">
        <form action="{{ route('category-create') }}" method="POST">
            @csrf
            <p>{{ __('message.blog-category') }}</p>
            @if(Session::has('create-category-success'))
            <span class="text-success">
                {{ __('message.create-category-success') }}
            </span>
            @endif
            @if(Session::has('create-category-failed'))
            <span class="text-danger">
                {{ __('message.create-category-failed') }}
            </span>
            @endif
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.category-name') }}</b><span>*</span></label>
                <input type="text" name="name">
                @error('name')
                <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="create-blog-form-submit">
                <button type="submit" class="create">{{ __('message.create-category') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
