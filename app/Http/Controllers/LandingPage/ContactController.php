<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display contact page.
     */
    public function index()
    {
        return view('LandingPage.Contact', [
            'settings' => SiteSetting::allAsArray(),
            'gallery' => GalleryPhoto::all()->keyBy('slot_key'),
        ]);
    }

    /**
     * Store contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            // 'g-recaptcha-response' => 'required|captcha', // Uncomment if using reCAPTCHA
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => 'Baru',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}

