<div class="main-content">
    <header>
        <div class="header-title">
            <div class="header-title-dashboard">
                <p><label for=""></label>{{ __('message.dashboard') }}
                <p>
            </div>
            <div class="header-title-user" id="toggleFrofile">
                <span onclick="showProfile()">{{ $auth->name }}</span>
                <span onclick="showProfile()">
                    @if ($auth->avatar)
                    <img src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}">
                    @endif
                </span>
                <div class="header-title-user-profile" id="profile">
                    <ul>
                        <li><a href="{{ route('profile.index') }}">{{ __('message.profile') }}</a></li>
                        <li><a href="{{ route('change.password') }}">{{ __('message.change-password') }}</a></li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a href="#" onclick="this.parentNode.submit();">{{ __('message.logout') }}</a>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
