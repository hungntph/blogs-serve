@if ($auth)
    <div class="blog-container-detail-input">
    @if ($auth->avatar)
    <img id="" src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}"/>
    @endif
        <form id="createComment">
            <input type="text" name="content" id="content">
            <input type="submit" hidden>
        </form>
    </div>
@endif

<div id="commentList">
@foreach ($blog->comments as $comment)
    <div class="blog-container-detail-comments">
        <div class="blog-container-detail-comments-user">
            @if ($comment->user->avatar)
            <img id="" src="{{ Vite::asset('public/storage/upload/' . $comment->user->avatar) }}"/>
            @endif
            <p>{{ $comment->user->name }}</p>
        </div>
        <div class="blog-container-detail-comments-content">
            <span id="content">{{ $comment->content }}</span>
            <p id="time">{{ $comment->created_at }}</p>
        </div>
        @if ($comment->user->id == $auth->id)
        <div class="blog-container-detail-comments-edit">
          <i class="fa-solid fa-pen-to-square"></i>
          <i class="fa-solid fa-trash"></i>
        </div>
        @endif

    </div>
@endforeach
</div>
