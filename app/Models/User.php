<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'gender',
        'avatar',
        'role',
        'status',
        'token',
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
