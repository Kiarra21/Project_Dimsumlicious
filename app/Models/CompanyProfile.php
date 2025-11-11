<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profile';

    protected $fillable = [
        'company_name',
        'about_us',
        'address',
        'phone',
        'whatsapp',
        'email',
        'logo',
        'hero_image',
        'social_media',
    ];

    protected $casts = [
        'social_media' => 'array', // Cast JSON ke array
    ];

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
