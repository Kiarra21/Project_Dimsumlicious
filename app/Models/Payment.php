<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'proof_image',
        'uploaded_at',
        'verified_by',
        'verified_at',
        'verification_notes',
        'qris_image',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'uploaded_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Relasi: Payment belongs to Order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi: Payment verified by User (admin/staff)
     */
    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
