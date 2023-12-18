<div class="blog-container-detail-like">
    <form id="toggleLike">
        <button type="submit">
            <i class="fa fa-heart fa-2x"></i>
        </button>
    </form>
    <div class="blog-container-detail-like-count">
        <p id="totalLike">{{ $blog->likes->count() }}</p>
    </div>
</div>
