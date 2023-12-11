<?php
namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait BlogGate
{
    public function blogGate()
    {
        Gate::define('edit', function ($user, $blog) {
            return $user->id == $blog->user_id;
        });

        Gate::define('show', function ($user, $blog) {
            return $user->id == $blog->user_id;
        });

        Gate::define('update', function ($user, $blog) {
            return $user->id == $blog->user_id;
        });
    }
}
