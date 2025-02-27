<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
