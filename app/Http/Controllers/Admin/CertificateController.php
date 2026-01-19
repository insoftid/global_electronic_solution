<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Get all certificates.
     */
    public function index(Request $request)
    {
        $query = Certificate::ordered();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $certificates = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'certificates' => $certificates,
                'total' => $certificates->count(),
            ]);
        }

        return response()->json(['certificates' => $certificates]);
    }

    /**
     * Store a new certificate.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        try {
            $imagePath = $this->fileUploadService->upload($request->file('image'), 'certificates');

            $certificate = Certificate::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'image_path' => $imagePath,
                'display_order' => $validated['display_order'] ?? 0,
                'is_active' => $request->boolean('is_active'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sertifikat berhasil ditambahkan',
                'certificate' => $certificate,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan sertifikat',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified certificate.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'display_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        try {
            if ($request->hasFile('image')) {
                $this->fileUploadService->delete($certificate->image_path);
                $validated['image_path'] = $this->fileUploadService->upload($request->file('image'), 'certificates');
            }

            $certificate->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'image_path' => $validated['image_path'] ?? $certificate->image_path,
                'display_order' => $validated['display_order'] ?? $certificate->display_order,
                'is_active' => $request->boolean('is_active'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Sertifikat berhasil diperbarui',
                'certificate' => $certificate,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui sertifikat',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified certificate.
     */
    public function destroy(Certificate $certificate)
    {
        $this->fileUploadService->delete($certificate->image_path);
        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sertifikat berhasil dihapus',
        ]);
    }
}
