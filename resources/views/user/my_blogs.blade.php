@extends('layouts.master')

@section('content')

@include('layouts.navbar')

<div class="my-blogs">
    <div class="row">
        @foreach ($blogs as $blog)
        <div class="col-md-4 col-lg-4 col-sx-12 col-sm-6">
            <div class="card">
                @if ($blog->image)
                    <img src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}" class="card-img-top img-size " alt="...">
                @else
                    <img src="/image/default-blog.png" class="card-img-top img-size " alt="...">
                @endif
                <div class="card-body">
                    <div class="author-time">
                        <h7 class="author"><i class='bx bx-user'></i>{{ $auth->name }}</h7>
                        <h7 class="time"><i class="bi bi-clock"></i>{{ $blog->created_at->diffForHumans() }}</h7>
                    </div>
                    <h6 class="card-text">{{ $blog->title }}</h6>
                    <p class="card-text">{{ $blog->short_content }}</p>
                    <div class="read-more">
                        <form action="{{ route('blog.show', $blog->id) }}" method="GET">
                            <button type="submit">
                            {{ __('message.view-blog') }} &nbsp;&nbsp;&nbsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 20 10" fill="none">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('blog.edit', $blog->id) }}" method="GET">
                            <button type="submit">
                            {{ __('message.edit-blog') }} &nbsp;&nbsp;&nbsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 20 10" fill="none">
                                    <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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

@endsection
