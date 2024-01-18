@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

<div class="list" id="popup">
    @if(Session::has('delete-category-success'))
    <span class="text-success">
        {{ __('message.delete-category-success') }}
    </span>
    @endif
    @if(Session::has('delete-category-failed'))
    <span class="text-danger">
        {{ __('message.delete-category-failed') }}
    </span>
    @endif
    <div class="list-header">
        <div class="list-header-create">
            <span>{{ __('message.ul-total') }}: </span><span>{{ $categories->count() }}</span>
            <button><a href="{{ route('category-index') }}">New Category</a></button>
        </div>
        <div class="list-header-search">
            <form action="{{ route('category-list') }}" method="GET">
                <input type="text" name="query" value="{{ old('query', request()->input('query')) }}" placeholder="Search ...">
                <button type="submit">
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                </button>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('message.ul-name') }}</th>
                <th scope="col">{{ __('message.cl-blogs-total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $category)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $category->name }}</td>
                <td>{{ $category->blogs->count() }}</td>
                <td>
                    <a href="{{ route('category-edit', $category->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="delete-category" data-id="{{ $category->id }}"><i class="fa-solid fa-trash"></i></a>
                </td>
                @include('admin.category_delete_popup')
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="list-pagination">
        <div>
            {{ $categories->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
