<?php
namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait CommentGate
{
    public function commentGate()
    {
        Gate::define('update-comment', function ($user, $comment) {
            return $user->id == $comment->user_id;
        });

        Gate::define('delete-comment', function ($user, $comment) {
            return $user->id == $comment->user_id;
        });
    }
}
