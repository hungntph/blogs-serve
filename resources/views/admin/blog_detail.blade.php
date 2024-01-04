@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

@php
use App\Models\Blog;
@endphp

<div class="edit-blog">
    <div class="edit-blog-link">
        <div>
            <a href="{{ route('blog-list') }}">{{ __('message.bl-blog-list') }}</a> > <span>{{ __('message.edit-blog') }}</span>
        </div>
        <form action="{{ route('toggle-approved', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="edit-blog-link-btn">
                @if($blog->status == Blog::STATUS_NOT_APPROVED)
                <button type="submit" class="approved">{{ __('message.blog-approved') }}</button>
                @else
                <button type="submit" class="un-approved">{{ __('message.blog-unapproved') }}</button>
                @endif
            </div>
        </form>
    </div>
    <div class="create-blog-form">
        <form action="{{ route('blog-update', $blog->id) }}" enctype="multipart/form-data" method="POST">
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
                <div>
                    <label for="name"><b>{{ __('message.blog-category') }}</b><span>*</span></label>
                </div>
                <select name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-blog-form-input">
                <label for="name"><b>{{ __('message.blog-title') }}</b><span>*</span></label>
                <input type="text" name="title" value="{{$blog->title}}">
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
                    <img id="showImage" src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}" />
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
                    <textarea name="content">{{ $blog->content }}</textarea>
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

@endsection
