@php
    // Gallery slots configuration
    $slots = [
        ['key' => 'hero_landing', 'label' => 'Hero — Beranda', 'placement' => 'Ditampilkan di hero halaman Landing Page'],
        ['key' => 'hero_portfolio', 'label' => 'Hero — Produk', 'placement' => 'Ditampilkan di hero halaman Portfolio'],
        ['key' => 'hero_contact', 'label' => 'Hero — Kontak', 'placement' => 'Ditampilkan di hero halaman Contact'],
        ['key' => 'about_1', 'label' => 'Tentang kami', 'placement' => 'Ditampilkan pada bagian Tentang Kami'],
        ['key' => 'about_2', 'label' => 'Visi Misi — Gambar 1', 'placement' => 'Ditampilkan pada bagian Visi Misi (posisi 1)'],
        ['key' => 'about_3', 'label' => 'Visi Misi — Gambar 2', 'placement' => 'Ditampilkan pada bagian Visi Misi (posisi 2)'],
    ];

    // Get gallery from database
    $galleryPhotos = \App\Models\GalleryPhoto::all()->keyBy('slot_key');
@endphp


<section>
    <div class="flex flex-col lg:flex-row gap-5 overflow-hidden">
        {{-- IDENTITY FORM --}}
        <div class="bg-white rounded-xl w-full lg:w-5/8">
            <div class="p-5 border-b border-gray-300">
                <h2 class="font-bold text-lg">Identitas Website</h2>
                <span class="text-sm font-base text-graytext">Mengubah data utama yang tampil di Header, Footer, dan
                    Halaman Kontak</span>
            </div>
            <form id="identityForm" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row p-5 gap-5">
                    <div class="w-full md:w-1/2">
                        <div class="mb-5">
                            <label for="company_name" class="font-bold text-md">Nama Perusahaan</label>
                            <input id="company_name" name="company_name" type="text"
                                class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                                value="{{ $settings['company_name'] ?? 'CV. Global Electronic Solution' }}">
                        </div>
                        <div data-field="logo">
                            <div class="text-md font-bold">Logo</div>
                            <div
                                class="h-24 md:h-28 lg:h-32 bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
                                @if(isset($settings['logo']) && $settings['logo'])
                                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="preview-placeholder">Preview Foto</span>
                                @endif
                            </div>
                            <label for="photos_logo"
                                class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                                <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No
                                    file chosen</span>
                                <input id="photos_logo" type="file" name="logo" accept="image/*"
                                    class="hidden file-input" />
                                <span
                                    class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose
                                    File</span>
                            </label>
                            <p class="text-[10px] text-graytext">PNG, JPG, WebP, SVG (Max 2 MB).</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="mb-5">
                            <label for="tagline" class="font-bold text-md">Tagline</label>
                            <input id="tagline" name="tagline" type="text"
                                class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                                value="{{ $settings['tagline'] ?? '' }}">
                        </div>
                        <div data-field="favicon">
                            <div class="text-md font-bold">Favicon</div>
                            <div
                                class="h-24 md:h-28 lg:h-32 bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
                                @if(isset($settings['favicon']) && $settings['favicon'])
                                    <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="preview-placeholder">Preview Foto</span>
                                @endif
                            </div>
                            <label for="photos_favicon"
                                class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                                <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No
                                    file chosen</span>
                                <input id="photos_favicon" type="file" name="favicon" accept="image/*"
                                    class="hidden file-input" />
                                <span
                                    class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose
                                    File</span>
                            </label>
                            <p class="text-[10px] text-graytext">PNG, JPG, WebP, SVG (Max 2 MB).</p>
                        </div>
                    </div>
                </div>

                <div id="identityMessage" class="hidden mx-5 mb-3 text-sm py-2 px-3 rounded-lg"></div>

                <div class="flex justify-end p-5 gap-3">
                    <a href="{{ route('admin.settings') }}"
                        class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit"
                        class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Simpan
                        Identitas</button>
                </div>
            </form>
        </div>

        {{-- CONTACT & SOCIAL FORM --}}
        <div class="bg-white rounded-xl w-full lg:w-3/8">
            <div class="p-5 border-b border-gray-300">
                <h2 class="font-bold text-lg">Kontak & Sosial</h2>
                <span class="text-sm font-base text-graytext">Dipakai untuk footer dan halaman kontak.</span>
            </div>
            <form id="contactForm">
                @csrf
                <div class="flex flex-col md:flex-row p-5 gap-5">
                    <div class="w-full md:w-1/2">
                        <div>
                            <label for="email" class="font-bold text-md">Email</label>
                            <input id="email" name="email" type="email"
                                class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                                value="{{ $settings['email'] ?? '' }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div>
                            <label for="whatsapp" class="font-bold text-md">WhatsApp</label>
                            <input id="whatsapp" name="whatsapp" type="text"
                                class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                                value="{{ $settings['whatsapp'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="address" class="font-bold text-md">Alamat</label>
                    <textarea id="address" name="address"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">{{ $settings['address'] ?? '' }}</textarea>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="google_maps_url" class="font-bold text-md">Google Maps</label>
                    <input id="google_maps_url" name="google_maps_url" type="text"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                        value="{{ $settings['google_maps_url'] ?? '' }}">
                    <p class="text-[10px] text-graytext">Link digunakan untuk menampilkan lokasi pada halaman kontak.
                    </p>
                </div>

                <div id="contactMessage" class="hidden mx-5 mb-3 text-sm py-2 px-3 rounded-lg"></div>

                <div class="flex justify-end p-5 gap-3">
                    <a href="{{ route('admin.settings') }}"
                        class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit"
                        class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Simpan Kontak</button>
                </div>
            </form>

            {{-- SOCIAL FORM --}}
            <form id="socialForm" class="border-t border-gray-200">
                @csrf
                <div class="mx-5 mt-5 mb-2.5">
                    <label for="instagram_url" class="font-bold text-md">Instagram</label>
                    <input id="instagram_url" name="instagram_url" type="text"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                        value="{{ $settings['instagram_url'] ?? '' }}">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="tiktok_url" class="font-bold text-md">TikTok</label>
                    <input id="tiktok_url" name="tiktok_url" type="text"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                        value="{{ $settings['tiktok_url'] ?? '' }}">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="youtube_url" class="font-bold text-md">YouTube</label>
                    <input id="youtube_url" name="youtube_url" type="text"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                        value="{{ $settings['youtube_url'] ?? '' }}">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="facebook_url" class="font-bold text-md">Facebook</label>
                    <input id="facebook_url" name="facebook_url" type="text"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1"
                        value="{{ $settings['facebook_url'] ?? '' }}">
                </div>

                <div id="socialMessage" class="hidden mx-5 mb-3 text-sm py-2 px-3 rounded-lg"></div>

                <div class="flex justify-end p-5 gap-3">
                    <a href="{{ route('admin.settings') }}"
                        class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit"
                        class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Simpan Sosial</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ABOUT FORM --}}
    <div class="bg-white rounded-xl w-full mt-5">
        <div class="p-5 border-b border-gray-300">
            <h2 class="font-bold text-lg">Tentang Kami</h2>
            <span class="text-sm font-base text-graytext">Deskripsi, Visi, Misi, dan Kebijakan Mutu</span>
        </div>
        <form id="aboutForm">
            @csrf
            <div class="p-5 space-y-4">
                <div>
                    <label for="about_description" class="font-bold text-md">Deskripsi Tentang Kami</label>
                    <textarea id="about_description" name="about_description"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-28">{{ $settings['about_description'] ?? '' }}</textarea>
                </div>
                <div>
                    <label for="about_vision" class="font-bold text-md">Visi</label>
                    <textarea id="about_vision" name="about_vision"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">{{ $settings['about_vision'] ?? '' }}</textarea>
                </div>
                <div>
                    <label for="about_mission" class="font-bold text-md">Misi</label>
                    <textarea id="about_mission" name="about_mission"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">{{ $settings['about_mission'] ?? '' }}</textarea>
                </div>
                <div>
                    <label for="quality_policy" class="font-bold text-md">Kebijakan Mutu</label>
                    <textarea id="quality_policy" name="quality_policy"
                        class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">{{ $settings['quality_policy'] ?? '' }}</textarea>
                </div>
            </div>

            <div id="aboutMessage" class="hidden mx-5 mb-3 text-sm py-2 px-3 rounded-lg"></div>

            <div class="flex justify-end p-5 gap-3">
                <a href="{{ route('admin.settings') }}"
                    class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                <button type="submit" class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Simpan
                    About</button>
            </div>
        </form>
    </div>

    {{-- GALLERY SECTION --}}
    <div class="bg-white rounded-xl w-full mt-5">
        <div class="p-5 border-b border-gray-300 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg">Galeri Foto</h2>
                <span class="text-sm font-base text-graytext">Upload foto untuk Hero dan bagian About Us.</span>
            </div>
            <div class="text-sm text-gray-500">PNG, JPG, WebP, SVG (Max 2 MB).</div>
        </div>

        <div class="p-5">
            <p class="text-sm text-gray-600 mb-3">Batas unggah: maksimal 6 foto total — 3 foto untuk Hero dan 3 foto
                untuk bagian About Us.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($slots as $slot)
                    @php
                        $photo = $galleryPhotos[$slot['key']] ?? null;
                    @endphp
                    <div class="border rounded-lg p-4" data-slot="{{ $slot['key'] }}" data-id="{{ $photo->id ?? '' }}">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="text-sm font-semibold text-gray-800">{{ $slot['label'] }}</div>
                                <div class="text-xs text-gray-500">{{ $slot['placement'] }}</div>
                            </div>
                        </div>

                        <div
                            class="h-36 md:h-44 lg:h-48 bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
                            @if($photo && $photo->image_path)
                                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $slot['label'] }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="preview-placeholder">Preview Foto</span>
                            @endif
                        </div>

                        <form class="gallery-form" data-slot="{{ $slot['key'] }}" data-id="{{ $photo->id ?? '' }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="text-sm text-gray-700">Pilih Foto</div>
                                <label for="photos_{{ $slot['key'] }}"
                                    class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                                    <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No
                                        file chosen</span>
                                    <input id="photos_{{ $slot['key'] }}" type="file" name="image" accept="image/*"
                                        class="hidden file-input" />
                                    <span
                                        class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose
                                        File</span>
                                </label>
                            </div>

                            <label class="block text-sm text-gray-700 mb-2">Caption (opsional)</label>
                            <input type="text" name="caption"
                                class="block w-full border border-gray-200 rounded-lg p-2 text-sm mb-3"
                                placeholder="Caption singkat untuk foto" value="{{ $photo->caption ?? '' }}" />

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-3 py-1 bg-green-600 text-white rounded text-sm">Upload</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Toast Notification Container --}}
<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

{{-- AJAX Scripts with Loading & Toast --}}
<script>
    (function () {
        const csrfToken = '{{ csrf_token() }}';

        // Using global showToast and setButtonLoading from Header.blade.php

        // Generic form submit handler
        async function handleFormSubmit(form, url, isFormData = false) {
            const submitBtn = form.querySelector('button[type="submit"]');
            setButtonLoading(submitBtn, true);

            try {
                const options = {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                };

                if (isFormData) {
                    options.body = new FormData(form);
                } else {
                    options.headers['Content-Type'] = 'application/json';
                    options.body = JSON.stringify(Object.fromEntries(new FormData(form)));
                }

                const response = await fetch(url, options);
                const result = await response.json();

                if (response.ok) {
                    showToast(result.message || 'Data berhasil disimpan!', 'success');
                } else {
                    const errorObj = formatApiError(response, result);
                    showToast(errorObj, 'error');
                }
            } catch (err) {
                showToast({
                    title: 'Koneksi Error',
                    message: 'Gagal menghubungi server',
                    details: [`• ${err.message || 'Network request failed'}`]
                }, 'error');
            } finally {
                setButtonLoading(submitBtn, false);
            }
        }

        // Identity Form (with file upload)
        document.getElementById('identityForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await handleFormSubmit(e.target, '{{ route("admin.settings.identity") }}', true);
        });

        // Contact Form
        document.getElementById('contactForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await handleFormSubmit(e.target, '{{ route("admin.settings.contact") }}', false);
        });

        // Social Form
        document.getElementById('socialForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await handleFormSubmit(e.target, '{{ route("admin.settings.social") }}', false);
        });

        // About Form
        document.getElementById('aboutForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await handleFormSubmit(e.target, '{{ route("admin.settings.about") }}', false);
        });

        // Gallery Forms
        document.querySelectorAll('.gallery-form').forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const galleryId = form.dataset.id;
                if (!galleryId) {
                    showToast('Gallery slot belum tersedia di database', 'error');
                    return;
                }

                const submitBtn = form.querySelector('button[type="submit"]');
                setButtonLoading(submitBtn, true);

                const formData = new FormData(form);
                try {
                    const response = await fetch(`/admin/gallery/${galleryId}`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                        body: formData,
                    });
                    const result = await response.json();

                    if (response.ok) {
                        showToast(result.message || 'Gambar berhasil diupload!', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        const errorObj = formatApiError(response, result);
                        showToast(errorObj, 'error');
                    }
                } catch (err) {
                    showToast({
                        title: 'Koneksi Error',
                        message: 'Gagal menghubungi server',
                        details: [`• ${err.message || 'Network request failed'}`]
                    }, 'error');
                } finally {
                    setButtonLoading(submitBtn, false);
                }
            });
        });

        // File preview
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function () {
                // Find the correct container: first try data-field (logo/favicon), then data-slot (gallery), then parent label's parent div
                const container = this.closest('[data-field]') || this.closest('[data-slot]') || this.closest('label')?.parentElement;
                const fileNameSpan = this.closest('label')?.querySelector('.file-name');
                const previewArea = container?.querySelector('.preview-area');

                if (this.files && this.files.length > 0) {
                    const file = this.files[0];
                    if (fileNameSpan) fileNameSpan.textContent = file.name;
                    if (previewArea) {
                        const url = URL.createObjectURL(file);
                        previewArea.innerHTML = `<img src="${url}" alt="${file.name}" class="w-full h-full object-cover">`;
                    }
                    showToast(`File "${file.name}" siap untuk diupload`, 'success', 2000);
                }
            });
        });
    })();
</script>