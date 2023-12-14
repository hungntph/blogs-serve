@extends('layouts.master')

@section('content')

@include('layouts.navbar')

<div class="blog" id="popup">
    <div class="blog-container">
        <div class="blog-container-detail">
            <div class="blog-container-detail-link">
                <a href=" {{ route('home') }} ">{{ __('message.home') }}</a> > <span>{{ __('message.detail-blog') }}</span>
            </div>
            <div class="blog-container-detail-title">
                <p>{{ $blog->title }}</p>
            </div>
            <div class="blog-container-detail-info">
                <div class="blog-container-detail-info-user">
                     @if ($blog->user->avatar)
                        <img id="" src="{{ Vite::asset('public/storage/upload/' . $blog->user->avatar) }}"/>
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
                            <button onclick="tooglePoup()">{{ __('message.blog-delete') }}</button>
                        </div>
                    @endif
                </div>   
            </div>
            <div class="blog-container-detail-image">
                @if ($blog->image)
                <img id="" src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}"/>
                @endif
            </div>
            <div class="blog-container-detail-desc">
                <p>{{ $blog->content }}</p>
            </div>
            <div class="blog-container-detail-comment">
                <span>{{ __('message.blog-related') }}</span>
            </div>
            <div class="blog-container-detail-line">
                <hr>
            </div>
            <div class="blog-container-detail-related">
                <div class="row">
                    @foreach ($relatedBlogs as $relateBlog)
                    <div class="col-md-3 col-lg-3 col-sx-12 col-sm-6">
                        <div class="card">
                            <a href="{{ route('blog.show', $relateBlog->id) }}">
                                @if ($relateBlog->image)
                                <img src="{{ Vite::asset('public/storage/upload/' . $relateBlog->image) }}"/>
                                @endif
                            </a>
                            <div class="card-body">
                                <a href="{{ route('blog.show', $relateBlog->id) }}">{{ $relateBlog->title }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="blog-container-detail-comment">
                <span>{{ __('message.blog-comment') }}</span>
            </div>
            <div class="blog-container-detail-line">
                <hr>
            </div>
            @if ($auth)
            <div class="blog-container-detail-input">
                @if ($auth->avatar)
                <img id="" src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}"/>
                @endif
                <input type="text">
            </div>
            @endif
            @foreach ($blog->comments as $comment)
            <div class="blog-container-detail-comments">
                <div class="blog-container-detail-comments-user">
                    @if ($comment->user->avatar)
                    <img id="" src="{{ Vite::asset('public/storage/upload/' . $comment->user->avatar) }}"/>
                    @endif
                    <p>{{ $comment->user->name }}</p>
                </div>
                <div class="blog-container-detail-comments-content">
                    <span>{{ $comment->content }}</span>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @include('layouts.footer')
    </div>

    @include('blogs.delete_blog_popup')

</div>

<script src="{{ Vite::asset('resources/js/app.js') }}"></script>

@endsection
