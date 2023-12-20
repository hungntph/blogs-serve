<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Traits\BlogGate;
use App\Traits\CommentGate;

class AuthServiceProvider extends ServiceProvider
{
    use BlogGate;
    use CommentGate;
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->blogGate();
        $this->commentGate();
    }
}
