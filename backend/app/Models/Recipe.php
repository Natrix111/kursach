<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'ingredients',
        'instructions',
        'images',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'images' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    protected $appends = ['is_favorite', 'can_edit'];
    public function getIsFavoriteAttribute()
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $user->favoriteRecipes()->where('recipe_id', $this->id)->exists();
    }

    public function getCanEditAttribute(): bool
    {
        return $this->user_id === Auth::id();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
