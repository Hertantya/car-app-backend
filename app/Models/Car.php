<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'type',
        'image_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function preferences()
    {
        return $this->hasMany(UserPreference::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
