<div class="navbar" id="navbar" style="position: fixed;">
    <div class="navbar-logo">
        <img src="/image/logo-regit.png">
        <span>RT-Blogs</span>
        <div class="navbar-logo-input">
            <input type="text" placeholder="{{ __('message.blog-search') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9.13101 0C14.1659 0 18.2613 4.00508 18.2613 8.9289C18.2613 11.2519 17.3497 13.3707 15.8579 14.9608L18.7933 17.8254C19.068 18.0941 19.0689 18.5287 18.7942 18.7974C18.6573 18.9331 18.4764 19 18.2964 19C18.1173 19 17.9373 18.9331 17.7994 18.7992L14.8286 15.902C13.2659 17.126 11.2844 17.8587 9.13101 17.8587C4.09613 17.8587 -0.000213623 13.8527 -0.000213623 8.9289C-0.000213623 4.00508 4.09613 0 9.13101 0ZM9.13101 1.37537C4.87152 1.37537 1.40618 4.76336 1.40618 8.9289C1.40618 13.0944 4.87152 16.4833 9.13101 16.4833C13.3896 16.4833 16.8549 13.0944 16.8549 8.9289C16.8549 4.76336 13.3896 1.37537 9.13101 1.37537Z"
                    fill="#A7A7A7" />
                </svg>
        </div>
    </div>
    <div class="navbar-menu">
        <div class="navbar-menu-btn">
            <button>{{ __('message.top') }}</button>
        </div>
        <div>
            <a href="{{ route('blog.index') }}">{{ __('message.create-blog') }}</a>
        </div>
        @if ($auth)
        <div class="navbar-menu-user">
            <a href="#">{{ $auth->name }}</a>
            @if ($auth->avatar)
            <img src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}" alt="">
            @endif
        </div>
        @endif
    </div>
</div>
