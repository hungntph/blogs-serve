<div class="main-content">
    <header>
        <div class="header-title">
            <div class="header-title-dashboard">
                <p><label for=""></label>{{ __('message.dashboard') }}
                <p>
            </div>
            <div class="header-title-user" id="toggleFrofile">
                <span>{{ $auth->name }}</span>
                <span>
                    @if ($auth->avatar)
                    <img src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}" alt="">
                    @endif
                    <img>
                </span>
                <div class="header-title-user-profile" id="profile">
                    <ul>
                        <li><a href="{{ route('profile.index') }}">{{ __('message.profile') }}</a></li>
                        <li><a href="{{ route('change.password') }}">{{ __('message.change-password') }}</a></li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"><li><a>{{ __('message.logout') }}</a></li></button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
