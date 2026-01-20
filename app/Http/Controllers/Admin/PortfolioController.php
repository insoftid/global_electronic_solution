<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Certificate;
use App\Models\Partner;
use App\Models\SiteSetting;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display portfolio management page.
     */
    public function index(Request $request)
    {
        $query = Portfolio::with(['category', 'tags', 'images'])->ordered();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        $portfolios = $query->get();

        if ($request->wantsJson()) {
            return response()->json([
                'portfolios' => $portfolios,
                'total' => $portfolios->count(),
            ]);
        }

        return view('Admin.LandingPage', [
            'portfolios' => $portfolios,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'certificates' => Certificate::orderBy('display_order')->get(),
            'partners' => Partner::orderBy('display_order')->get(),
            'settings' => SiteSetting::allAsArray(),
        ]);
    }

    /**
     * Store a newly created portfolio.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'detail' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'youtube_url' => 'nullable|url',
            'project_date' => 'nullable|date',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            // Project metrics
            'efficiency_increase' => 'nullable|string|max:50',
            'waste_reduction' => 'nullable|string|max:50',
            'roi_months' => 'nullable|string|max:50',
            'downtime_reduction' => 'nullable|string|max:50',
            'quality_rate' => 'nullable|string|max:50',
        ]);

        try {
            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $this->fileUploadService->upload($request->file('thumbnail'), 'portfolios');
            }

            $portfolio = Portfolio::create([
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? null,
                'slug' => Str::slug($validated['title']),
                'description' => $validated['description'],
                'detail' => $validated['detail'] ?? null,
                'category_id' => $validated['category_id'] ?? null,
                'youtube_url' => $validated['youtube_url'] ?? null,
                'project_date' => $validated['project_date'] ?? null,
                'thumbnail' => $thumbnailPath,
                'is_featured' => $validated['is_featured'] ?? false,
                'is_active' => $request->boolean('is_active'),
                'display_order' => $validated['display_order'] ?? 0,
                // Project metrics
                'efficiency_increase' => $validated['efficiency_increase'] ?? null,
                'waste_reduction' => $validated['waste_reduction'] ?? null,
                'roi_months' => $validated['roi_months'] ?? null,
                'downtime_reduction' => $validated['downtime_reduction'] ?? null,
                'quality_rate' => $validated['quality_rate'] ?? null,
            ]);

            // Attach tags
            if (!empty($validated['tags'])) {
                $portfolio->tags()->sync($validated['tags']);
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Portfolio berhasil ditambahkan',
                    'portfolio' => $portfolio->load(['category', 'tags']),
                ]);
            }

            return back()->with('success', 'Portfolio berhasil ditambahkan');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan portfolio',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return back()->with('error', 'Gagal menambahkan portfolio: ' . $e->getMessage());
        }
    }

    /**
     * Get single portfolio for editing.
     */
    public function show(Portfolio $portfolio)
    {
        return response()->json([
            'portfolio' => $portfolio->load(['category', 'tags', 'images']),
        ]);
    }

    /**
     * Update the specified portfolio.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'detail' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'youtube_url' => 'nullable|url',
            'project_date' => 'nullable|date',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            // Project metrics
            'efficiency_increase' => 'nullable|string|max:50',
            'waste_reduction' => 'nullable|string|max:50',
            'roi_months' => 'nullable|string|max:50',
            'downtime_reduction' => 'nullable|string|max:50',
            'quality_rate' => 'nullable|string|max:50',
        ]);

        try {
            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($portfolio->thumbnail) {
                    $this->fileUploadService->delete($portfolio->thumbnail);
                }
                $validated['thumbnail'] = $this->fileUploadService->upload($request->file('thumbnail'), 'portfolios');
            }

            $portfolio->update([
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? null,
                'description' => $validated['description'],
                'detail' => $validated['detail'] ?? null,
                'category_id' => $validated['category_id'] ?? null,
                'youtube_url' => $validated['youtube_url'] ?? null,
                'project_date' => $validated['project_date'] ?? null,
                'thumbnail' => $validated['thumbnail'] ?? $portfolio->thumbnail,
                'is_featured' => $validated['is_featured'] ?? false,
                'is_active' => $request->boolean('is_active'),
                'display_order' => $validated['display_order'] ?? 0,
                // Project metrics
                'efficiency_increase' => $validated['efficiency_increase'] ?? null,
                'waste_reduction' => $validated['waste_reduction'] ?? null,
                'roi_months' => $validated['roi_months'] ?? null,
                'downtime_reduction' => $validated['downtime_reduction'] ?? null,
                'quality_rate' => $validated['quality_rate'] ?? null,
            ]);

            // Sync tags
            $portfolio->tags()->sync($validated['tags'] ?? []);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Portfolio berhasil diperbarui',
                    'portfolio' => $portfolio->load(['category', 'tags']),
                ]);
            }

            return back()->with('success', 'Portfolio berhasil diperbarui');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui portfolio',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return back()->with('error', 'Gagal memperbarui portfolio: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified portfolio.
     */
    public function destroy(Request $request, Portfolio $portfolio)
    {
        // Delete thumbnail
        if ($portfolio->thumbnail) {
            $this->fileUploadService->delete($portfolio->thumbnail);
        }

        // Delete portfolio images
        foreach ($portfolio->images as $image) {
            $this->fileUploadService->delete($image->image_path);
        }

        $portfolio->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Portfolio berhasil dihapus',
            ]);
        }

        return back()->with('success', 'Portfolio berhasil dihapus');
    }

    /**
     * Upload additional images to portfolio.
     */
    public function uploadImages(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        try {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $path = $this->fileUploadService->upload($image, 'portfolios/gallery');
                $portfolioImage = PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image_path' => $path,
                    'display_order' => $portfolio->images()->count(),
                ]);
                $uploadedImages[] = $portfolioImage;
            }

            return response()->json([
                'success' => true,
                'message' => count($uploadedImages) . ' gambar berhasil diupload',
                'images' => $uploadedImages,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload gambar',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete portfolio image.
     */
    public function deleteImage(Request $request, PortfolioImage $portfolioImage)
    {
        $this->fileUploadService->delete($portfolioImage->image_path);
        $portfolioImage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus',
        ]);
    }
}
