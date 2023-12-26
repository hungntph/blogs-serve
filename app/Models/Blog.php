<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    const STATUS_NOT_APPROVED = 0;
    const STATUS_APPROVED = 1;
    const STATUSES = [
        0 => 'Not approved',
        1 => 'Approved',
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
        return $query->where('status', Blog::STATUS_APPROVED);
    }
}
