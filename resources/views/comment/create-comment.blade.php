<div id="comments">
    @if ($auth)
    <div class="blog-container-detail-input">
        @if ($auth->avatar)
        <img id="" src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}" />
        @endif
        <form id="createComment">
            <input type="text" name="content" id="content">
            <input type="hidden" name="blog_id" id="blogId">
            <input type="submit" hidden>
        </form>
    </div>
    @endif

    <div id="commentList">
        <div class="blog-container-detail-comments" id="list">
            @foreach ($blog->comments as $comment)
            <div class="userComment">
                <div class="blog-container-detail-comments-user">
                    @if ($comment->user->avatar)
                    <img id="" src="{{ Vite::asset('public/storage/upload/' . $comment->user->avatar) }}" />
                    @endif
                    <p>{{ $comment->user->name }}</p>
                </div>
                <div class="blog-container-detail-comments-content comment" comment-delete-route="{{ route('comment.destroy', $comment->id) }}" id="{{ $comment->id }}">
                    <div class="blog-container-detail-comments-content-icon">
                        <p id="content">{{ $comment->content }}</p>
                        @if ($auth && $comment->user->id == $auth->id)
                        <div class="blog-container-detail-comments-edit">
                            <span class="show-edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span class="delete">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                        @endif
                    </div>
                    <span id="time">{{ $comment->created_at }}</span>
                </div>
                <form id="formEdit" class="update hidden" comment-update-route="{{ route('comment.update', $comment->id) }}">
                    <input type="hidden" id="id" name="id" value="{{ $comment->id }}">
                    <input id="comment" name="comment" value="{{ $comment->content }}">
                    <button type="submit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <span class="cancel-edit">
                        <i class="fa-solid fa-trash"></i>
                    </span>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
