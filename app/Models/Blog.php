<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    const STATUS_NOT_APPROVED = 0;
    const STATUS_APPROVED = 1;
    const CONTENT_LIMIT = 50;
    const STATUSES = [
        0 => 'Not approved',
        1 => 'Approved',
    ];

    const ORDER_BY = [
        'newest' => 'Newest',
        'like' => 'Likes',
    ];

    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'blog_id', 'user_id');
    }

    public function scopeApproved($query): Builder
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function getShortContentAttribute()
    {
        return Str::limit($this->content, self::CONTENT_LIMIT, '...');
    }

    public function scopePopular($query, $year)
    {
        return $query->whereYear('created_at', $year);
    }
}
