<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'discount',
        'banner_image',
        'start_date',
        'end_date',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi: Promo dibuat oleh User (Admin/Staff)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope: Hanya promo yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Promo yang sedang berjalan (dalam periode)
     */
    public function scopeOngoing($query)
    {
        $today = Carbon::today();
        return $query->where('is_active', true)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today);
    }

    /**
     * Check apakah promo masih berlaku
     */
    public function isValid(): bool
    {
        $today = Carbon::today();
        return $this->is_active 
               && $this->start_date <= $today 
               && $this->end_date >= $today;
    }
}
