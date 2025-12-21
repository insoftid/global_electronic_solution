<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Silakan centang kotak reCAPTCHA untuk membuktikan Anda bukan robot.',
        ]);

        // Verify reCAPTCHA with Google API
        $recaptchaSecret = config('services.recaptcha.secret');
        $recaptchaResponse = $request->input('g-recaptcha-response');

        // Check if secret is configured
        if (empty($recaptchaSecret)) {
            // If no secret configured, skip reCAPTCHA verification (for development)
            Log::warning('reCAPTCHA secret not configured. Skipping verification.');
        } else {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip(),
            ]);

            $recaptchaResult = $response->json();

            // Log for debugging
            Log::info('reCAPTCHA verification result', ['result' => $recaptchaResult]);

            if (!isset($recaptchaResult['success']) || $recaptchaResult['success'] !== true) {
                $errorCodes = $recaptchaResult['error-codes'] ?? [];
                Log::error('reCAPTCHA verification failed', ['errors' => $errorCodes]);
                
                return back()
                    ->withInput()
                    ->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.']);
            }
        }

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


