<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// use App\Models\User;

class Post extends Model
{
    use Sluggable;
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    
    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function like(): HasMany
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}