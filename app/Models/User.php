<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    const STATUS_NOT_VERIFIED = 0;
    const STATUS_BLOCKED = 1;
    const STATUS_VERIFIED = 2;
    const ADMIN_ROLE = 2;
    const USER_ROLE = 0;
    const GENDER = [
        0 => 'Male',
        1 => 'Female',
    ];
    const STATUSES = [
        0 => 'Not verified',
        1 => 'Block',
        2 => 'Verified',
    ];

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
        'mail_verify_at',
        'remember_token',
        'send_mail_verify',
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'likes', 'user_id', 'blog_id');
    }

    public function scopePopular($query, $year)
    {
        return $query->whereYear('created_at', $year);
    }
}
