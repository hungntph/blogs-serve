@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

@php
use App\Models\Blog;
@endphp

<div class="list" id="popup">
    @if(Session::has('delete-blog-success'))
    <span class="text-sm text-red-500">
        {{ __('message.delete-blog-success') }}
    </span>
    @endif
    @if(Session::has('delete-blog-failed'))
    <span class="text-sm text-red-500">
        {{ __('message.delete-blog-failed') }}
    </span>
    @endif

    <div class="list-header">
        <div>
            <span>{{ __('message.ul-total') }}: </span><span>{{ $blogs->count() }}</span>
        </div>
        <form action="{{ route('blog-list') }}" method="GET">
            <div class="list-header-search">
                @if (request()->input('category_id'))
                <input name="category_id" value="{{ request()->input('category_id') }}" hidden>
                @endif
                <input type="text" name="query" value="{{ old('query', request()->input('query')) }}" placeholder="Search blog">
                <button type="submit">
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                </button>
            </div>
        </form>
        <form action="{{ route('blog-list') }}" method="GET">
            <div class="list-header-select">
                @if (request()->input('query'))
                <input name="query" value="{{ request()->input('query') }}" hidden>
                @endif
                <select name="category_id" id="category" onchange="this.form.submit()">
                    <option value="">Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == request()->input('category_id') ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('message.bl-title') }}</th>
                <th scope="col">{{ __('message.bl-image') }}</th>
                <th scope="col">{{ __('message.bl-author') }}</th>
                <th scope="col">{{ __('message.bl-category') }}</th>
                <th scope="col">{{ __('message.ul-status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $key => $blog)
            <tr>
                <th scope="row">{{ $blog->id }}</th>
                <td>{{ $blog->title }}</td>
                <td>
                    @if ($blog->image)
                    <img src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}" alt="">
                    @endif
                </td>
                <td>{{ $blog->user->name }}</td>
                <td>{{ $blog->category->name }}</td>
                <td>{{ Blog::STATUSES[$blog->status] }}</td>
                <td>
                    <a href="{{ route('blog-edit', $blog->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a onclick="tooglePopup()"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            @include('admin.blog_delete_popup')
            @endforeach
        </tbody>
    </table>
    <div class="list-pagination">
        <div>
            {{ $blogs->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection
