<div class="block-popup" id="blockPopup">
    <form action="{{ route('login') }}" method="GET">
        <div class="blog-popup-content">
            <span>{{ __('message.block-message') }}</span>
        </div>
        <div class="block-popup-button">
            <button type="submit">{{ __('message.block-confirm') }}</button>
        </div>
    </form>
</div>
