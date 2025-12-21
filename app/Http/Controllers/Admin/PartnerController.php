<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Get all partners.
     */
    public function index(Request $request)
    {
        $query = Partner::ordered();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $partners = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'partners' => $partners,
                'total' => $partners->count(),
            ]);
        }

        return response()->json(['partners' => $partners]);
    }

    /**
     * Store a new partner.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $logoPath = $this->fileUploadService->upload($request->file('logo'), 'partners');

        $partner = Partner::create([
            'name' => $validated['name'],
            'website_url' => $validated['website_url'] ?? null,
            'description' => $validated['description'] ?? null,
            'logo_path' => $logoPath,
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Partner berhasil ditambahkan',
            'partner' => $partner,
        ]);
    }

    /**
     * Update the specified partner.
     */
    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'website_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $this->fileUploadService->delete($partner->logo_path);
            $validated['logo_path'] = $this->fileUploadService->upload($request->file('logo'), 'partners');
        }

        $partner->update([
            'name' => $validated['name'],
            'website_url' => $validated['website_url'] ?? null,
            'description' => $validated['description'] ?? null,
            'logo_path' => $validated['logo_path'] ?? $partner->logo_path,
            'display_order' => $validated['display_order'] ?? $partner->display_order,
            'is_active' => $validated['is_active'] ?? $partner->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Partner berhasil diperbarui',
            'partner' => $partner,
        ]);
    }

    /**
     * Remove the specified partner.
     */
    public function destroy(Partner $partner)
    {
        $this->fileUploadService->delete($partner->logo_path);
        $partner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Partner berhasil dihapus',
        ]);
    }
}
