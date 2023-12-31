@extends('layouts.master')

@section('content')

@include('layouts.navbar')

<div id="route" like-route="{{ route('like.blog') }}" comment-create-route="{{ route('comment.create') }}"></div>

<div class="blog" id="popup">
    <div class="blog-container">
        <div class="blog-container-detail">
            <div class="blog-container-detail-link">
                <a href=" {{ url()->previous() }} ">{{ __('message.back') }}</a> > <span>{{ __('message.detail-blog') }}</span>
            </div>
            <div class="blog-container-detail-title">
                <p>{{ $blog->title }}</p>
            </div>
            <div class="blog-container-detail-info">
                <div class="blog-container-detail-info-user">
                    @if ($blog->user->avatar)
                    <img id="" src="{{ Vite::asset('public/storage/upload/' . $blog->user->avatar) }}" />
                    @endif
                    <div>
                        <a href="">{{ $blog->user->name }}</a>
                        <p>{{ $blog->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
                <div class="blog-container-detail-info-btn">
                    @if ($auth && $blog->user_id == $auth->id)
                    @if ($blog->status == 1)
                    <div class="blog-container-detail-info-btn-approved">
                        <button>{{ __('message.blog-approved') }}</button>
                    </div>
                    @elseif ($blog->status == 0)
                    <div class="blog-container-detail-info-btn-notapproved">
                        <button>{{ __('message.blog-notapproved') }}</button>
                    </div>
                    @endif
                    <div class="blog-container-detail-info-btn-delete">
                        <button onclick="tooglePopup()">{{ __('message.blog-delete') }}</button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="blog-container-detail-image">
                @if ($blog->image)
                    <img src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}" />
                @else
                    <img src="/image/default-blog.png">
                @endif
            </div>
            <div class="blog-container-detail-desc">
                <p>{{ $blog->content }}</p>
            </div>

            @include('like.create-like')

            <div class="blog-container-detail-comment">
                <span>{{ __('message.blog-related') }}</span>
            </div>
            <div class="blog-container-detail-line">
                <hr>
            </div>
            <div class="blog-container-detail-related">
                <div class="row">
                    @foreach ($relatedBlogs as $relateBlog)
                    <div id="item" class="col-md-3 col-lg-3 col-sx-12 col-sm-6 slides">
                        <div class="card">
                            <a href="{{ route('blog.show', $relateBlog->id) }}">
                                @if ($relateBlog->image)
                                <img src="{{ Vite::asset('public/storage/upload/' . $relateBlog->image) }}" />
                                @else
                                <img src="/image/default-blog.png" alt="">
                                @endif
                            </a>
                            <div class="card-body">
                                <a href="{{ route('blog.show', $relateBlog->id) }}">{{ $relateBlog->title }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="slide">
                    @foreach ($relatedBlogs as $key => $relateBlog)
                    <span class="dot" onclick="currentSlide({{$key+1}})"></span>
                    @endforeach
                </div>
            </div>

            <div class="blog-container-detail-comment">
                <span>{{ __('message.blog-comment') }}</span>
            </div>
            <div class="blog-container-detail-line">
                <hr>
            </div>

            @include('comment.create-comment')

        </div>

        @include('layouts.footer')

    </div>

    @include('blogs.delete_blog_popup')

</div>

<script type="module" src="{{ Vite::asset('resources/js/ajax/like.js') }}"></script>
<script type="module" src="{{ Vite::asset('resources/js/ajax/comment.js') }}"></script>

@endsection
