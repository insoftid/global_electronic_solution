@php
    // define six slots: first 3 = Hero (Landing / Portfolio / Contact), next 3 = About Us
    $slots = [
        ['key' => 'hero_landing', 'label' => 'Hero — Beranda', 'placement' => 'Ditampilkan di hero halaman Landing Page'],
        ['key' => 'hero_portfolio', 'label' => 'Hero — Produk', 'placement' => 'Ditampilkan di hero halaman Portfolio'],
        ['key' => 'hero_contact', 'label' => 'Hero — Kontak', 'placement' => 'Ditampilkan di hero halaman Contact'],
        ['key' => 'about_1', 'label' => 'Tentang kami', 'placement' => 'Ditampilkan pada bagian Tentang Kami'],
        ['key' => 'about_2', 'label' => 'Visi Misi — Gambar 1', 'placement' => 'Ditampilkan pada bagian Visi Misi (posisi 1)'],
        ['key' => 'about_3', 'label' => 'Visi Misi — Gambar 1', 'placement' => 'Ditampilkan pada bagian Visi Misi (posisi 2)'],
    ];

    // dummy existing images for preview (could be loaded from DB)
    $existing = [
        'hero_landing' => 'img/bghero.png',
        'hero_portfolio' => 'img/bghero.png',
        'hero_contact' => 'img/bghero.png',
        'about_1' => 'img/bghero.png',
        'about_2' => 'img/bghero.png',
        'about_3' => 'img/bghero.png',
    ];

    $favicon = 'img/logo_cv_ges.png';
    $logo = 'img/logo_cv_ges.png';
@endphp


<section>
    <div class="flex flex-col lg:flex-row gap-5 overflow-hidden">
        <div class="bg-white rounded-xl w-full lg:w-5/8">
            <div class="p-5 border-b border-gray-300">
                <h2 class="font-bold text-lg">Identitas Website</h2>
                <span class="text-sm font-base text-graytext">Mengubah data utama yang tampil di Header, Footer, dan Halaman Kontak</span>
            </div>
            <form action="POST">
                <div class="flex flex-col md:flex-row p-5 gap-5">
                    <div class="w-full md:w-1/2">
                        <div class="mb-5">
                            <label for="Nama" class="font-bold text-md">Nama Perusahaan</label>
                            <input id="Nama" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="CV. Global Electronic Solution">
                        </div>
                        <div>
                            <div class="text-md font-bold">Logo</div>
                            <div class="h-24 md:h-28 lg:h-32 bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
                                @if($logo)
                                <img src="{{ asset($logo) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <span class="preview-placeholder">Preview Foto</span>
                                @endif
                            </div>
                            <label for="photos_logo" class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                                <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No file chosen</span>
                                <input id="photos_logo" type="file" name="photos[logo]" accept="image/*" class="hidden file-input" />
                                <span class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose File</span>
                            </label>
                            <p class="text-[10px] text-graytext" id="favicon_input_help">SVG, PNG or JPG (Max 2 MB).</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="mb-5">
                            <label for="Nama" class="font-bold text-md">Tagline</label>
                            <input id="Nama" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="CV. Global Electronic Solution">
                        </div>
                        <div>
                            <div class="text-md font-bold">Favicon</div>
                            <div class="h-24 md:h-28 lg:h-32 bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
                                @if($favicon)
                                <img src="{{ asset($favicon) }}" alt="Favicon" class="w-full h-full object-cover">
                                @else
                                    <span class="preview-placeholder">Preview Foto</span>
                                @endif
                            </div>
                            <label for="photos_favicon" class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                                <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No file chosen</span>
                                <input id="photos_favicon" type="file" name="photos[favicon]" accept="image/*" class="hidden file-input" />
                                <span class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose File</span>
                            </label>
                            <p class="text-[10px] text-graytext" id="favicon_input_help">SVG, PNG or JPG (Max 2 MB).</p>
                        </div>
                    </div>
                </div>

                <!-- About / Visi / Misi (full-width, not flex) -->
                <div class="p-5 border-t border-gray-100 w-full">
                    <div class="mb-4 w-full">
                        <label for="about_description" class="font-bold text-md">Deskripsi Tentang Kami</label>
                        <textarea id="about_description" name="about_description" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-28 md:h-32" placeholder="Tuliskan deskripsi singkat tentang perusahaan..."></textarea>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="about_vision" class="font-bold text-md">Visi</label>
                        <textarea id="about_vision" name="about_vision" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24 md:h-28" placeholder="Tuliskan visi perusahaan..."></textarea>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="about_mission" class="font-bold text-md">Misi</label>
                        <textarea id="about_mission" name="about_mission" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24 md:h-28" placeholder="Tuliskan misi perusahaan..."></textarea>
                    </div>
                </div>

                <div class="flex justify-end p-5 gap-3">
                    <a href="/admin/settings" class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit" class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Submit</button>
                </div>
            </form>
        </div>
        <div class="bg-white rounded-xl w-full lg:w-3/8">
            <div class="p-5 border-b border-gray-300">
                <h2 class="font-bold text-lg">Kontak & Sosial</h2>
                <span class="text-sm font-base text-graytext">Dipakai untuk footer dan halaman kontak.</span>
            </div>
            <form action="POST">
                <div class="flex flex-col md:flex-row p-5 gap-5">
                    <div class="w-full md:w-1/2">
                        <div>
                            <label for="Email" class="font-bold text-md">Email</label>
                            <input id="Email" type="email" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="cs@globalelectronicsolution.com">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div>
                            <label for="WhatsApp" class="font-bold text-md">WhatsApp</label>
                            <input id="WhatsApp" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="+6282120205757">
                        </div>
                    </div>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="alamat" class="font-bold text-md">Alamat</label>
                    <textarea id="alamat" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">Jl. Gondang Timur II No. 2, Kel. Bulusan, Kec. Tembalang, Kota Semarang, Jawa Tengah, Indonesia 50277</textarea>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="maps" class="font-bold text-md">Google Maps</label>
                    <input id="maps" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://goo.gl/maps/example">
                    <p class="text-[10px] text-graytext" id="logo_input_help">Link digunakan untuk menampilkan lokasi pada halaman kontak.</p>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="ig" class="font-bold text-md">Instagram</label>
                    <input id="ig" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://instagram.com/example">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="tiktok" class="font-bold text-md">TikTok</label>
                    <input id="tiktok" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://tiktok.com/example">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="youtube" class="font-bold text-md">YouTube</label>
                    <input id="youtube" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://youtube.com/example">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="facebook" class="font-bold text-md">Facebook</label>
                    <input id="facebook" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://facebook.com/example">
                </div>
                <div class="flex justify-end p-5 gap-3">
                    <a href="/admin/settings" class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit" class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white rounded-xl w-full mt-5">
        <div class="p-5 border-b border-gray-300 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg">Galeri Foto</h2>
                <span class="text-sm font-base text-graytext">Upload foto + caption + urutan.</span>
            </div>
            <div class="text-sm text-gray-500">PNG/JPG, max 3MB.</div>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="p-5">
            <p class="text-sm text-gray-600 mb-3">Batas unggah: maksimal 6 foto total — 3 foto untuk Hero (satu per page) dan 3 foto untuk bagian About Us. Setiap slot menunjukkan lokasi penempatan foto.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($slots as $slot)
                    <div class="border rounded-lg p-4" data-slot="{{ $slot['key'] }}">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="text-sm font-semibold text-gray-800">{{ $slot['label'] }}</div>
                                <div class="text-xs text-gray-500">{{ $slot['placement'] }}</div>
                            </div>
                            <div class="text-xs text-gray-400">Slot</div>
                        </div>

                        <div class="h-36 md:h-44 lg:h-48 bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
                            @if($existing[$slot['key']])
                                <img src="{{ asset($existing[$slot['key']]) }}" alt="{{ $slot['label'] }}" class="w-full h-full object-cover">
                            @else
                                <span class="preview-placeholder">Preview Foto</span>
                            @endif
                        </div>

                        <div>
                            <div class="text-sm text-gray-700">Pilih Foto</div>
                            <label for="photos_{{ $slot['key'] }}" class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                                <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No file chosen</span>
                                <input id="photos_{{ $slot['key'] }}" type="file" name="photos[{{ $slot['key'] }}]" accept="image/*" class="hidden file-input" />
                                <span class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose File</span>
                            </label>
                        </div>

                        <label class="block text-sm text-gray-700 mb-2">Caption (opsional)</label>
                        <input type="text" name="captions[{{ $slot['key'] }}]" class="block w-full border border-gray-200 rounded-lg p-2 text-sm mb-3" placeholder="Caption singkat untuk foto" />

                        <div class="flex justify-between">
                            <button type="button" class="px-3 py-1 border rounded text-sm">Edit</button>
                            <button type="button" class="px-3 py-1 bg-red-100 text-red-600 rounded text-sm">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 flex justify-end gap-3">
                <a href="/admin/settings" class="px-4 py-2 border rounded-lg text-sm">Reset</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm">Simpan</button>
            </div>
        </form>
        <!-- Image modal (hidden by default) -->
        <div id="image-modal" class="fixed inset-0 z-50 hidden bg-black/70 p-4" aria-hidden="true">
            <div class="flex items-center justify-center w-full h-full">
                <div class="relative max-w-[95%] max-h-[95%]">
                    <button id="image-modal-close" class="absolute top-2 right-2 bg-black/40 text-white rounded-full py-1 px-3 hover:bg-black/60">&times;</button>
                    <img id="image-modal-img" src="" alt="Full preview" class="w-full h-full object-contain rounded" />
                </div>
            </div>
        </div>

        <script>
            (function(){
                // Modal elements
                var modal = document.getElementById('image-modal');
                var modalImg = document.getElementById('image-modal-img');
                var modalClose = document.getElementById('image-modal-close');

                function openModal(src, alt) {
                    if (!src) return;
                    modalImg.src = src;
                    modalImg.alt = alt || '';
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    modal.setAttribute('aria-hidden','false');
                }

                function closeModal() {
                    modal.classList.add('hidden');
                    modalImg.src = '';
                    modal.setAttribute('aria-hidden','true');
                    document.body.style.overflow = '';
                }

                // Close handlers
                modalClose.addEventListener('click', closeModal);
                modal.addEventListener('click', function(e){
                    if (e.target === modal) closeModal();
                });
                document.addEventListener('keydown', function(e){
                    if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
                });

                // Attach click handler to any preview image inside .preview-area
                function attachPreviewClickHandlers(){
                    document.querySelectorAll('.preview-area').forEach(function(area){
                        var img = area.querySelector('img');
                        if (img){
                            img.style.cursor = 'zoom-in';
                            if (!img.dataset.hasPreviewHandler){
                                img.addEventListener('click', function(){ openModal(this.src, this.alt); });
                                img.dataset.hasPreviewHandler = '1';
                            }
                        }
                    });
                }

                // Update displayed filename and show image preview when a file is selected
                document.querySelectorAll('.file-input').forEach(function(input){
                    input.addEventListener('change', function(e){
                        var container = this.closest('[data-slot]');
                        if (!container) container = this.closest('label')?.closest('div') || document;

                        var fileNameSpan = container.querySelector('.file-name');
                        var previewArea = container.querySelector('.preview-area');

                        if (this.files && this.files.length > 0) {
                            var file = this.files[0];
                            if (fileNameSpan) fileNameSpan.textContent = file.name;

                            if (previewArea) {
                                // revoke previous objectURL if any
                                var previous = previewArea.getAttribute('data-object-url');
                                if (previous) { URL.revokeObjectURL(previous); previewArea.removeAttribute('data-object-url'); }

                                var url = URL.createObjectURL(file);
                                previewArea.setAttribute('data-object-url', url);
                                previewArea.innerHTML = '';
                                var img = document.createElement('img');
                                img.src = url;
                                img.alt = file.name || 'Preview';
                                img.className = 'w-full h-full object-cover';
                                previewArea.appendChild(img);

                                // attach click handler so user can open full image
                                attachPreviewClickHandlers();
                            }
                        } else {
                            if (fileNameSpan) fileNameSpan.textContent = 'No file chosen';
                            if (previewArea) {
                                previewArea.innerHTML = '<span class="preview-placeholder">Preview Foto</span>';
                                var previous = previewArea.getAttribute('data-object-url');
                                if (previous) { URL.revokeObjectURL(previous); previewArea.removeAttribute('data-object-url'); }
                            }
                        }
                    });
                });

                // Make existing previews clickable on load
                attachPreviewClickHandlers();
            })();
        </script>
    </div>
</section>