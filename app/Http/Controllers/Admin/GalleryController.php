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
        $isHeroLanding = $galleryPhoto->slot_key === 'hero_landing';

        $validated = $request->validate($isHeroLanding ? [
            'image' => 'required|file|mimes:jpeg,png,jpg,webp,svg,mp4,webm,ogg|max:51200',
            'caption' => 'nullable|string|max:255',
        ] : [
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $file = $request->file('image');
        $extension = strtolower($file?->getClientOriginalExtension() ?? '');
        $isVideo = $isHeroLanding && in_array($extension, ['mp4', 'webm', 'ogg'], true);

        if ($isVideo) {
            if ($galleryPhoto->video_path) {
                $this->fileUploadService->delete($galleryPhoto->video_path);
            }
            if ($galleryPhoto->image_path) {
                $this->fileUploadService->delete($galleryPhoto->image_path);
            }

            $videoPath = $this->fileUploadService->upload($file, 'gallery');

            $galleryPhoto->update([
                'video_path' => $videoPath,
                'image_path' => null,
                'caption' => $validated['caption'] ?? null,
            ]);
        } else {
            if ($galleryPhoto->image_path) {
                $this->fileUploadService->delete($galleryPhoto->image_path);
            }
            if ($galleryPhoto->video_path) {
                $this->fileUploadService->delete($galleryPhoto->video_path);
            }

            $imagePath = $this->fileUploadService->upload($file, 'gallery');

            $galleryPhoto->update([
                'image_path' => $imagePath,
                'video_path' => null,
                'caption' => $validated['caption'] ?? null,
            ]);
        }

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

        if ($galleryPhoto->video_path) {
            $this->fileUploadService->delete($galleryPhoto->video_path);
        }

        $galleryPhoto->update([
            'image_path' => null,
            'video_path' => null,
            'caption' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus',
        ]);
    }
}
