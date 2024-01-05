@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

@php
use App\Models\Blog;
@endphp

<div class="list" id="popup">
    @if(Session::has('delete-blog-success'))
    <span class="text-success">
        {{ __('message.delete-blog-success') }}
    </span>
    @endif
    @if(Session::has('delete-blog-failed'))
    <span class="text-danger">
        {{ __('message.delete-blog-failed') }}
    </span>
    @endif

    <div class="list-header">
        <div>
            <span>{{ __('message.ul-total') }}: </span><span>{{ $blogs->count() }}</span>
        </div>
    </div>

    <div class="list-search">
        <form action="{{ route('blog-list') }}" method="GET">
            <div class="list-search-search">
                <input type="text" name="query" value="{{ old('query', request()->input('query')) }}" placeholder="Search blog">
                <button type="submit">
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                </button>
            </div>

            <div class="list-search-select">
                <select name="order_by" id="orderBy" onchange="this.form.submit()">
                    <option value="">OrderBy</option>
                    @foreach (Blog::ORDER_BY as $key => $value)
                    <option value="{{ $key }}" {{ $key == request()->input('order_by') ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="list-search-select">
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="">Status</option>
                    @foreach (Blog::STATUSES as $key => $value)
                    <option value="{{ $key }}" {{ $key == request()->input('status') ? 'selected' : ''}} >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="list-search-select">
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
                <th scope="col">{{ __('message.bl-total-like') }}</th>
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
                <td>{{ $blog->likes->count() }}</td>
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
