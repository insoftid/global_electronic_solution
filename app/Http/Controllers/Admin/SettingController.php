<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display settings page.
     */
    public function index()
    {
        return view('Admin.Settings', [
            'settings' => SiteSetting::allAsArray(),
        ]);
    }

    /**
     * Update company identity settings.
     */
    public function updateIdentity(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,svg|max:1024',
        ]);

        SiteSetting::set('company_name', $validated['company_name']);
        SiteSetting::set('tagline', $validated['tagline'] ?? '');

        if ($request->hasFile('logo')) {
            $oldLogo = SiteSetting::get('logo');
            if ($oldLogo) {
                $this->fileUploadService->delete($oldLogo);
            }
            $logoPath = $this->fileUploadService->upload($request->file('logo'), 'settings');
            SiteSetting::set('logo', $logoPath);
        }

        if ($request->hasFile('favicon')) {
            $oldFavicon = SiteSetting::get('favicon');
            if ($oldFavicon) {
                $this->fileUploadService->delete($oldFavicon);
            }
            $faviconPath = $this->fileUploadService->upload($request->file('favicon'), 'settings');
            SiteSetting::set('favicon', $faviconPath);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Identitas perusahaan berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Identitas perusahaan berhasil diperbarui');
    }

    /**
     * Update about section settings.
     */
    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'about_description' => 'required|string',
            'about_vision' => 'required|string',
            'about_mission' => 'required|string',
            'quality_policy' => 'nullable|string',
        ]);

        SiteSetting::setMany([
            'about_description' => $validated['about_description'],
            'about_vision' => $validated['about_vision'],
            'about_mission' => $validated['about_mission'],
            'quality_policy' => $validated['quality_policy'] ?? '',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tentang Kami berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Tentang Kami berhasil diperbarui');
    }

    /**
     * Update contact information.
     */
    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'google_maps_url' => 'nullable|string|max:2000',
        ]);

        SiteSetting::setMany($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Informasi kontak berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Informasi kontak berhasil diperbarui');
    }

    /**
     * Update social media links.
     */
    public function updateSocial(Request $request)
    {
        $validated = $request->validate([
            'instagram_url' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|string|max:500',
            'youtube_url' => 'nullable|string|max:500',
            'tiktok_url' => 'nullable|string|max:500',
        ]);

        SiteSetting::setMany($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Social media berhasil diperbarui',
            ]);
        }

        return back()->with('success', 'Social media berhasil diperbarui');
    }

    /**
     * Update section visibility setting.
     */
    public function updateSectionVisibility(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string|in:portfolio,certificate,partner',
            'is_active' => 'required|string|in:0,1',
        ]);

        $settingKey = 'section_' . $validated['section'] . '_active';
        SiteSetting::set($settingKey, $validated['is_active']);

        $sectionNames = [
            'portfolio' => 'Proyek',
            'certificate' => 'Sertifikat',
            'partner' => 'Kerjasama',
        ];
        $sectionName = $sectionNames[$validated['section']] ?? $validated['section'];
        $status = $validated['is_active'] === '1' ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json([
            'success' => true,
            'message' => "Section {$sectionName} berhasil {$status}",
        ]);
    }
}
