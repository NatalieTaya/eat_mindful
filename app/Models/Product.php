<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'protein', 'fats', 'carbs', 'fibre', 'kkal'
    ];
    
    public function entries(): HasMany {
        return $this->hasMany(Entry::class);
    }
}
