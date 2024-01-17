<div class="sidebar">
    <div class="sidebar-logo">
        <img src="/image/logo-regit.png">
        <span>RT-Blogs</span>
    </div>
    <div class="sidebar-menu">
        <ul>
        <li class="sidebar-menu-item">
                <a href="{{ route('admin.index') }}" class="{{ (\Request::route()->getName() == 'admin.index') ? 'active' : '' }}">
                    <span><i class="fa-solid fa-chart-line"></i></span>
                    <span>{{ __('message.dashboard') }}</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('user-list') }}" class="{{ (\Request::route()->getName() == 'user-list') ? 'active' : '' }}">
                    <span><i class="fa-solid fa-users"></i></span>
                    <span>{{ __('message.ul-user-list') }}</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('blog-list') }}" class="{{ (\Request::route()->getName() == 'blog-list') ? 'active' : '' }}">
                    <span><i class="fa-solid fa-blog"></i></span>
                    <span>{{ __('message.bl-blog-list') }}</span>
                </a>
            </li>
            <li class="sidebar-menu-item">  
                <a href="{{ route('category-list') }}" class="{{ (\Request::route()->getName() == 'category-list') ? 'active' : '' }}">
                    <span><i class="fa-solid fa-list"></i></span>
                    <span>{{ __('message.cl-category-list') }}</span>
                </a>
            </li>
            <li class="sidebar-menu-item">  
                <a href="{{ route('home') }}">
                    <span><i class="fa-solid fa-house" class="{{ (\Request::route()->getName() == 'home') ? 'active' : '' }}"></i></span>
                    <span>{{ __('message.home') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
