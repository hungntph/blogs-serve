@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="edit-blog">
    <div class="edit-blog-link">
        <div>
            <a href="{{ route('category-list') }}">{{ __('message.cl-category-list') }}</a> > <span>{{ __('message.edit-category') }}</span>
        </div>
    </div>
    <div class="create-blog-form">
        <form action="{{ route('category-update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <p>{{ __('message.blog-category') }}</p>
            @if(Session::has('update-category-success'))
            <span class="text-sm text-red-500">
                {{ __('message.update-category-success') }}
            </span>
            @endif
            @if(Session::has('update-category-failed'))
            <span class="text-sm text-red-500">
                {{ __('message.update-category-failed') }}
            </span>
            @endif
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.category-name') }}</b><span>*</span></label>
                <input type="text" name="name" value="{{ $category->name }}">
                @error('name')
                <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror
            </div>
            <div class="create-blog-form-submit">
                <button type="submit" class="create">{{ __('message.save') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
