<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Get all gallery slots.
     */
    public function index()
    {
        return response()->json([
            'gallery' => GalleryPhoto::all(),
        ]);
    }

    /**
     * Update a gallery slot image.
     */
    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        // Delete old image if exists
        if ($galleryPhoto->image_path) {
            $this->fileUploadService->delete($galleryPhoto->image_path);
        }

        $imagePath = $this->fileUploadService->upload($request->file('image'), 'gallery');

        $galleryPhoto->update([
            'image_path' => $imagePath,
            'caption' => $validated['caption'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diperbarui',
            'gallery' => $galleryPhoto,
        ]);
    }

    /**
     * Remove image from gallery slot (set to null).
     */
    public function removeImage(GalleryPhoto $galleryPhoto)
    {
        if ($galleryPhoto->image_path) {
            $this->fileUploadService->delete($galleryPhoto->image_path);
        }

        $galleryPhoto->update([
            'image_path' => null,
            'caption' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus',
        ]);
    }
}
