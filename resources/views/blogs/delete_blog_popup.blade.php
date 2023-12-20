<div class="blog-popup">
    <form action="{{ route('blog.destroy', $blog->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="user_id" value="{{ $blog->user_id }}">
        <input type="hidden" name="image" value="{{ $blog->image }}">
        <div class="blog-popup-top">
            <p>{{ __('message.delete') }}</p>
            <img src="/image/x.png" onclick="tooglePoup()">
        </div>
        <div class="blog-popup-content">
            <span>{{ __('message.delete-confirm') }}</span>
        </div>
        <div class="blog-popup-button">
            <div class="blog-popup-button-cancel">
                <a onclick="tooglePoup()">{{ __('message.cancel') }}</a>
            </div>
            <div class="blog-popup-button-delete">
                <button type="submit">{{ __('message.delete') }}</button>
            </div>
        </div>
    </form>
</div>
