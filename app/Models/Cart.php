<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function cartProducts(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }
}
