<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'promo_id',
        'has_discount',
        'discount_price',
        'stock',
        'image',
        'is_available',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'has_discount' => 'boolean',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Relasi: Produk belongs to Kategori
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Produk belongs to Promo
     */
    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class);
    }

    /**
     * Relasi: Produk memiliki banyak item di keranjang
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Relasi: Produk memiliki banyak order items
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get harga akhir (pakai discount_price kalau has_discount=true)
     */
    public function getFinalPrice()
    {
        return $this->has_discount && $this->discount_price ? $this->discount_price : $this->price;
    }
}
