<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display portfolio listing page.
     */
    public function index(Request $request)
    {
        $query = Portfolio::active()->ordered()->with(['category', 'tags']);

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return view('LandingPage.Portfolio', [
            'settings' => SiteSetting::allAsArray(),
            'gallery' => GalleryPhoto::all()->keyBy('slot_key'),
            'portfolios' => $query->paginate(3),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Display single portfolio detail.
     */
    public function show(Portfolio $portfolio)
    {
        // Ensure portfolio is active
        if (!$portfolio->is_active) {
            abort(404);
        }

        // Load relationships
        $portfolio->load(['category', 'tags', 'images']);

        return view('LandingPage.PortDetail', [
            'settings' => SiteSetting::allAsArray(),
            'gallery' => GalleryPhoto::all()->keyBy('slot_key'),
            'portfolio' => $portfolio,
            'relatedPortfolios' => Portfolio::active()
                ->where('id', '!=', $portfolio->id)
                ->where('category_id', $portfolio->category_id)
                ->limit(3)
                ->get(),
        ]);
    }
}

