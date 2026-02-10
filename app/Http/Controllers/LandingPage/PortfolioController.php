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
            'portfolios' => $query->paginate(9),
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

    // Load relationships (include variants + variant images)
    $portfolio->load(['category', 'tags', 'variants.images']);

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

    /**
     * AJAX search portfolios.
     */
    public function searchAjax(Request $request)
    {
        $query = Portfolio::active()->ordered()->with(['category', 'tags']);

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search by title, subtitle, description
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('subtitle', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $portfolios = $query->paginate(9);

        // Return HTML partial for AJAX
        if ($request->ajax() || $request->wantsJson()) {
            $html = view('LandingPage.Component.PortfolioGrid', [
                'portfolios' => $portfolios
            ])->render();

            return response()->json([
                'html' => $html,
                'hasMore' => $portfolios->hasMorePages(),
                'total' => $portfolios->total(),
                'currentPage' => $portfolios->currentPage(),
                'lastPage' => $portfolios->lastPage(),
            ]);
        }

        return redirect()->route('portfolio.index');
    }
}

