@extends('layouts.master')

@section('content')

@include('layouts.header')

<div class="detail-blog">
    <div class="detail-blog-link">
        <a href="">{{ __('message.home') }}</a> > <span>{{ __('message.edit-blog') }}</span>
    </div>
    <div class="detail-blog-title">
        <p>{{ $blog->title }}</p>
    </div>
    <div class="detail-blog-info">
        <div class="detail-blog-info-user">
            @if ($blog->user->avatar)
            <img id="" src="{{ Vite::asset('public/storage/upload/' . $blog->user->avatar) }}"/>
            @endif
            <div>
                <a href="">{{ $blog->user->name }}</a>
                <p>{{ $blog->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="detail-blog-info-btn">
            @if ($blog->status == 1)
            <div class="detail-blog-info-btn-approved">
                <button>{{ __('message.blog-approved') }}</button>   
            </div>
            @elseif ($blog->status == 0)
            <div class="detail-blog-info-btn-notapproved">
                <button>{{ __('message.blog-notapproved') }}</button>   
            </div>
            @endif
            <div class="detail-blog-info-btn-delete">
                <button onclick="openForm()">{{ __('message.blog-delete') }}</button>
            </div>
        </div>
    </div>
    <div class="detail-blog-image">
        <img id="" src="{{ Vite::asset('public/storage/upload/' . $blog->image) }}"/>
    </div>
    <div class="detail-blog-desc">
        <p>{{ $blog->content }}</p>
    </div>
    <div class="detail-blog-comment">
        <span>{{ __('message.blog-comment') }}</span>
    </div>
    <div class="detail-blog-line">
        <hr>
    </div>
    <div class="detail-blog-input">
        @if ($blog->user->avatar)
        <img id="" src="{{ Vite::asset('public/storage/upload/' . $blog->user->avatar) }}"/>
        @endif
        <input type="text">
    </div>
    @foreach ($blog->comments as $comment)
    <div class="detail-blog-comments">
        <div class="detail-blog-comments-user">
            @if ($comment->user->avatar)
            <img id="" src="{{ Vite::asset('public/storage/upload/' . $comment->user->avatar) }}"/>
            @endif
            <p>{{ $comment->user->name }}</p>
        </div>
        <div class="detail-blog-comments-content">
            <span>{{ $comment->content }}</span>
            <p>{{ $comment->created_at->diffForHumans() }}</p>
        </div>
    </div>
    @endforeach
</div>

@include('layouts.footer')

@endsection
