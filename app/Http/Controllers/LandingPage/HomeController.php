<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Certificate;
use App\Models\Partner;
use App\Models\GalleryPhoto;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        return view('LandingPage.Homepage', [
            'settings' => SiteSetting::allAsArray(),
            'portfolios' => Portfolio::active()
                ->featured()
                ->ordered()
                ->limit(6)
                ->with(['category', 'tags'])
                ->get(),
            'certificates' => Certificate::active()->ordered()->get(),
            'partners' => Partner::active()->ordered()->get(),
            'gallery' => GalleryPhoto::all()->keyBy('slot_key'),
        ]);
    }
}
