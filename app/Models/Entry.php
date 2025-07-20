<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    use HasFactory;
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
    public function meal(): BelongsTo {
        return $this->belongsTo(Meal::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
