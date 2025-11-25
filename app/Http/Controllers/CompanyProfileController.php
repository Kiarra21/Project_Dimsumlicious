<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    /**
     * Display company profile page (admin only)
     */
    public function index()
    {
        // Get company profile from database
        $profile = CompanyProfile::getProfile();
        
        // Format data untuk view
        $companyData = [
            'name' => $profile->company_name,
            'tagline' => $profile->tagline ?? 'Kelezatan Dimsum Autentik',
            'description' => $profile->about_us,
            'address' => $profile->address,
            'phone' => $profile->phone,
            'email' => $profile->email,
            'whatsapp' => $profile->whatsapp,
            'operating_hours' => [
                'weekdays' => $profile->operating_hours_weekdays ?? '09:00 - 21:00',
                'weekend' => $profile->operating_hours_weekend ?? '08:00 - 22:00'
            ],
            'social_media' => [
                'instagram' => $profile->instagram ?? '',
                'facebook' => $profile->facebook ?? '',
                'tiktok' => $profile->tiktok ?? ''
            ],
            'founded_year' => $profile->founded_year ?? 2019,
            'logo' => $profile->logo,
            'hero_image' => $profile->hero_image,
            'last_updated_by' => $profile->updater ? $profile->updater->name : null,
            'last_updated_at' => $profile->updated_at
        ];

        return view('admin.company-profile.index', compact('companyData'));
    }

    /**
     * Update company profile (admin only)
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'operating_hours_weekdays' => 'nullable|string|max:50',
            'operating_hours_weekend' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profile = CompanyProfile::getProfile();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company', 'public');
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            if ($profile->hero_image) {
                Storage::disk('public')->delete($profile->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('company', 'public');
        }

        // Update profile
        $profile->update([
            'company_name' => $validated['company_name'],
            'about_us' => $validated['description'] ?? $profile->about_us,
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'whatsapp' => $validated['whatsapp'] ?? $profile->whatsapp,
            'email' => $validated['email'],
            'logo' => $validated['logo'] ?? $profile->logo,
            'hero_image' => $validated['hero_image'] ?? $profile->hero_image,
        ]);

        // Store additional fields in a more structured way if needed
        // For now, we'll add them to the model
        $profile->tagline = $validated['tagline'] ?? null;
        $profile->operating_hours_weekdays = $validated['operating_hours_weekdays'] ?? null;
        $profile->operating_hours_weekend = $validated['operating_hours_weekend'] ?? null;
        $profile->instagram = $validated['instagram'] ?? null;
        $profile->facebook = $validated['facebook'] ?? null;
        $profile->tiktok = $validated['tiktok'] ?? null;
        $profile->updated_by = auth()->id(); // Track siapa yang edit
        $profile->save();
        
        return redirect()->route('company-profile.index')
                        ->with('success', 'Company profile berhasil diupdate!');
    }
}
