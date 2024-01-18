<div class="blog-popup">
    <form action="{{ route('blog-delete', $blog->id) }}" enctype="multipart/form-data" method="POST">
        @csrf   
        @method('DELETE')
        <div class="blog-popup-top">
            <p>{{ __('message.delete') }}</p>
            <img src="/image/x.png" onclick="tooglePopup()">
        </div>
        <div class="blog-popup-content">
            <input type="hidden" name="id">
            <span>{{ __('message.delete-confirm') }}</span>
        </div>
        <div class="blog-popup-button">
            <div class="blog-popup-button-cancel">
                <a onclick="tooglePopup()">{{ __('message.cancel') }}</a>
            </div>
            <div class="blog-popup-button-delete">
                <button type="submit">{{ __('message.delete') }}</button>
            </div>
        </div>
    </form>
</div>
