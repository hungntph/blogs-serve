
@extends('layouts.master')

@section('content')

@include('layouts.navbar')

<div class="create-blog">
    <div class="create-blog-link">
        <a href="{{ url()->previous() }}">{{ __('message.home') }}</a> > <span>{{ __('message.create-blog') }}</span>
    </div>
    <div class="create-blog-form">
        <form action="{{ route('blog.create') }}" enctype="multipart/form-data" method="POST">
        @csrf
            <p>{{ __('message.create-blog') }}</p>
            @if(Session::has('create-success'))
                <span class="text-success">
                    {{ __('message.create-success') }}
                </span>
            @endif
            @if(Session::has('create-failed'))
                <span class="text-danger">
                    {{ __('message.create-failed') }}
                </span>
            @endif
            <div class="create-blog-form-input">
                <input type="hidden" name="user_id" value="{{ $auth->id }}">
                <div>
                    <label for="name"><b>{{ __('message.blog-category') }}</b><span>*</span></label>
                </div>
                <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.blog-title') }}</b><span>*</span></label>
                <input type="text" name="title" value="{{ old('title', request()->input('title')) }}"> 
                @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="create-blog-form-upload">
                <div class="create-blog-form-upload-title">
                    <label for="name"><b>{{ __('message.blog-upload-image') }}</b><span>*</span></label>
                </div>
                <div class="create-blog-form-upload-btn">
                    <label for="uploadImg" class="">{{ __('message.blog-upload-image') }}</label>
                    <input accept="image/*" onchange="loadFile(event)" type="file" name="file" id="uploadImg" class="form-control-file" hidden>
                </div>
                <div class="create-blog-form-upload-image">
                    <img id="showImage"/>
                </div>
                @error('file')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.blog-desc') }}</b><span>*</span></label>
                <div>
                    <textarea name="content">{{ old('content', request()->input('content')) }}</textarea>
                </div>
                @error('content')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="create-blog-form-submit">
                <button type="submit" class="create">{{ __('message.create-blog') }}</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

@endsection
