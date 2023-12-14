
@extends('layouts.master')

@section('content')

@include('layouts.header')

@include('layouts.navbar')


<div class="blogs">
    <div class="blogs-title">
        <p class="blogs-title-name">List Blog</p>
        <form action="{{ route('home') }}" method="GET">
            @if (request()->input('query'))
            <input name="query" value="{{ request()->input('query') }}" hidden>
            @endif
            <select class="blogs-title-category" name="category_id" id="category" onchange="this.form.submit()">
                <option value="">Categories</option>
                @foreach ($categories as $category) 
                <option value="{{ $category->id }}" {{ $category->id == request()->input('category_id') ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="row">
        @foreach ($blogs as $blog)
        <div class="col-md-4 col-lg-4 col-sx-12 col-sm-6">
            <div class="card">
                <img src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}" class="card-img-top img-size " alt="...">
                <div class="card-body">
                    <div class="author-time">
                        <h7 class="author"><i class='bx bx-user'></i>{{ $blog->user->name }}</h7>
                        <h7 class="time"><i class="bi bi-clock"></i>{{ $blog->created_at->diffForHumans() }}</h7>
                    </div>
                    <h6 class="card-text">{{ $blog->title }}</h6>
                    <p class="card-text">{{ $blog->content }}</p>
                    <div class="read-more">
                    <form action="{{ route('blog.show', $blog->id) }}" method="GET">
                        @csrf
                        <button type="submit">
                            Read more &nbsp;&nbsp;&nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 20 10"
                                fill="none">
                                <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
        @endforeach
        <div class="blogs-pagination">
            {{ $blogs->withQueryString()->links() }}
        </div>
    </div>
</div>

@include('layouts.footer')

<script src="{{ Vite::asset('resources/js/app.js') }}"></script>

@endsection
