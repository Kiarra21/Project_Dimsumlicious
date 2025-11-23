<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PromoController extends Controller
{
    /**
     * Display promo management page
     */
    public function index()
    {
        $promos = Promo::with('creator')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($promo) {
                return [
                    'id' => $promo->id,
                    'title' => $promo->title,
                    'description' => $promo->description,
                    'discount' => $promo->discount ?? 0,
                    'start_date' => $promo->start_date->format('Y-m-d'),
                    'end_date' => $promo->end_date->format('Y-m-d'),
                    'status' => $promo->isValid() ? 'active' : 'expired',
                    'image' => $promo->banner_image,
                    'is_active' => $promo->is_active
                ];
            })->toArray();
        
        return view('admin.promos.index', compact('promos'));
    }

    /**
     * Store new promo
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount' => 'nullable|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('promos', 'public');
        }

        Promo::create($validated);
        
        return redirect()->route('promos.index')
                        ->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * Update promo
     */
    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount' => 'nullable|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($promo->banner_image) {
                Storage::disk('public')->delete($promo->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('promos', 'public');
        }

        $promo->update($validated);
        
        return redirect()->route('promos.index')
                        ->with('success', 'Promo berhasil diupdate!');
    }

    /**
     * Delete promo
     */
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        
        // Delete image if exists
        if ($promo->banner_image) {
            Storage::disk('public')->delete($promo->banner_image);
        }

        $promo->delete();
        
        return redirect()->route('promos.index')
                        ->with('success', 'Promo berhasil dihapus!');
    }
}
