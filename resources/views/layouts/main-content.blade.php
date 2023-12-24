<div class="main-content">
    <header>
        <div class="header-title">
            <div class="header-title-dashboard">
                <p><label for=""></label>{{ __('message.dashboard') }}
                <p>
            </div>
            <div class="header-title-user">
                <span>{{ $auth->name }}</span>
                <span>
                    @if ($auth->avatar)
                    <img src="{{ Vite::asset('public/storage/upload/' . $auth->avatar) }}" alt="">
                    @endif
                </span>
            </div>
        </div>
    </header>

    <main>
        <div class="cards">
            <div class="cards-single">
                <div>

                </div>
            </div>
        </div>
    </main>
</div>
