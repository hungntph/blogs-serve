<div class="blog-popup">
    <form action="{{ route('category-delete', $category->id) }}" enctype="multipart/form-data" method="POST">
        @csrf   
        @method('DELETE')
        <div class="blog-popup-top">
            <p>{{ __('message.delete') }}</p>
            <img src="/image/x.png" onclick="tooglePopup()">
        </div>
        <div class="blog-popup-content">
            <span>{{ __('message.delete-category-confirm') }}{{$category->id}}</span>
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
