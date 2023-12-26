<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/image/logo-regit.png">
        <span>RT-Blogs</span>
    </div>
    <div class="sidebar-menu">
        <ul>
        <li class="sidebar-menu-item">
                <a href="{{ route('admin.index') }}">
                    <span><i class="fa-solid fa-house"></i></span>
                    <span>{{ __('message.dashboard') }}</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('user-list') }}">
                    <span><i class="fa-solid fa-users"></i></span>
                    <span>{{ __('message.ul-user-list') }}</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('blog-list') }}">
                    <span><i class="fa-solid fa-blog"></i></span>
                    <span>{{ __('message.bl-blog-list') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
