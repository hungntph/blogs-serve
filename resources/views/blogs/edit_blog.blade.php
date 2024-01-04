@extends('layouts.master')

@section('content')

@include('layouts.navbar')

<div class="create-blog">
    <div class="create-blog-link">
        <a href="{{ route('blogs-user') }}">{{ __('message.my-blog') }}</a> > <span>{{ __('message.edit-blog') }}</span>
    </div>
    <div class="create-blog-form">
        <form action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
            <p>{{ __('message.edit-blog') }}</p>
            @if(Session::has('blog-update-success'))
                <span class="text-success">
                    {{ __('message.update-success') }}
                </span>
            @endif
            @if(Session::has('blog-update-failed'))
                <span class="text-danger">
                    {{ __('message.updaste-failed') }}
                </span>
            @endif
            <div class="create-blog-form-input">
                <input type="hidden" name="id" value="{{ $blog->id }}">
                <input type="hidden" name="user_id" value="{{ $blog->user_id }}">
                <div>
                    <label for="name"><b>{{ __('message.blog-category') }}</b><span>*</span></label>
                </div>
                <select name="category_id">
                @foreach ($categories as $category)
                    old('gender', $auth->gender)
                    <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.blog-title') }}</b><span>*</span></label>
                <input type="text" name="title" value="{{ old('title', $blog->title)}}"> 
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
                    @if ($blog->image) 
                    <img id="showImage" src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}"/>
                    @endif
                    <img id="showImage" />
                </div>
                @error('file')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.blog-desc') }}</b><span>*</span></label>
                <div>
                    <textarea name="content">{{ old('content', $blog->content)}}</textarea>
                </div>
                @error('content')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                @enderror 
            </div>
            <div class="create-blog-form-submit">
                <button type="submit" class="create">{{ __('message.edit-blog') }}</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

@endsection
