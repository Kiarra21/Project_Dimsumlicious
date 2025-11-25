<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyProfile extends Model
{
    protected $table = 'company_profile';

    protected $fillable = [
        'company_name',
        'tagline',
        'about_us',
        'address',
        'phone',
        'whatsapp',
        'email',
        'logo',
        'hero_image',
        'operating_hours_weekdays',
        'operating_hours_weekend',
        'instagram',
        'facebook',
        'tiktok',
        'founded_year',
        'updated_by',
    ];

    /**
     * Relasi: Company profile di-update oleh User (Admin)
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get company profile singleton
     * Hanya akan ada 1 record company profile
     */
    public static function getProfile()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'company_name' => 'Dimsumlicious',
                'about_us' => 'Dimsumlicious adalah penyedia dimsum berkualitas yang telah melayani ribuan pelanggan sejak tahun 2020.',
                'address' => 'Jl. Raya Dimsum No. 123, Jakarta Selatan',
                'phone' => '021-12345678',
                'whatsapp' => '081234567890',
                'email' => 'info@dimsumlicious.com',
            ]
        );
    }
}
