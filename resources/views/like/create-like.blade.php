<div class="blog-container-detail-like">
    <form id="toggleLike">
        @if ($auth)
        <button type="submit">
            <input type="hidden" name="blog_id" id="blogId" value="{{ $blog->id }}">
            <i class="{{ $checkLike ? 'active': '' }} fa fa-heart fa-2x"></i>
        </button>
        @else
        <i class="fa fa-heart fa-2x"></i>
        @endif
    </form>
    <div class="blog-container-detail-like-count">
        <p id="totalLike">{{ $blog->likes->count() }}</p>
    </div>
</div>
