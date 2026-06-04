<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * Kolom yang boleh diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi antara Category dan Product.
     * Satu category dapat memiliki banyak product.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}