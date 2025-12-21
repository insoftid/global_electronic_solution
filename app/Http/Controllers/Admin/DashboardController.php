<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Certificate;
use App\Models\Partner;
use App\Models\ContactMessage;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics.
     */
    public function index()
    {
        return view('Admin.Dashboard', [
            'stats' => [
                'newMessages' => ContactMessage::unread()->count(),
                'totalPortfolios' => Portfolio::active()->count(),
                'totalCertificates' => Certificate::active()->count(),
                'totalPartners' => Partner::active()->count(),
                'totalUsers' => User::count(),
            ],
            'recentContacts' => ContactMessage::latest()
                ->take(5)
                ->get(),
        ]);
    }
}
