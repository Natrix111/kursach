<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    protected $fillable = ['recipe_id', 'user_id', 'comment'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'recipe_id',
    ];

    protected $appends = ['can_edit'];

    public function getCanEditAttribute(): bool
    {
        return $this->user_id === Auth::id();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
