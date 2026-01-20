{{-- PROYEK / PORTFOLIO (partial) --}}
{{-- Uses $portfolios and $categories from controller --}}
<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Proyek / Portfolio</h3>
        <p class="text-xs text-gray-500 mt-1">
            Kelola daftar proyek yang tampil di landing page. Klik item untuk edit.
        </p>
    </div>

    <div class="px-5 py-5 space-y-4">
        {{-- GRID KIRI-KANAN --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

            {{-- KIRI: DAFTAR PROYEK --}}
            <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-900">Daftar Proyek</h4>
                        <p class="text-xs text-gray-500 mt-1">Klik baris untuk edit di panel kanan.</p>
                    </div>

                    <div class="flex gap-2">
                        <input id="projectSearch" type="text" placeholder="Cari judul..."
                            class="w-full sm:w-56 rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                        <button id="projNewBtn" type="button"
                            class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700 whitespace-nowrap">
                            + Tambah
                        </button>
                    </div>
                </div>

                <div class="mt-3 overflow-auto max-h-80">
                    <table class="min-w-full text-sm">
                        <thead class="sticky top-0 bg-white">
                            <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
                                <th class="py-3 pr-3">Judul</th>
                                <th class="py-3 pr-3">Kategori</th>
                                <th class="py-3 pr-3">Status</th>
                                <th class="py-3">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody id="projectBody">
                            @forelse($portfolios ?? [] as $p)
                                <tr class="project-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                                    data-id="{{ $p->id }}" data-title="{{ $p->title }}" data-subtitle="{{ $p->subtitle }}"
                                    data-description="{{ $p->description }}" data-detail="{{ $p->detail }}"
                                    data-category="{{ $p->category_id }}" data-youtube="{{ $p->youtube_url }}"
                                    data-date="{{ $p->project_date ? $p->project_date->format('Y-m-d') : '' }}"
                                    data-featured="{{ $p->is_featured ? 1 : 0 }}" data-active="{{ $p->is_active ? 1 : 0 }}"
                                    data-thumbnail="{{ $p->thumbnail }}" data-efficiency="{{ $p->efficiency_increase }}"
                                    data-waste="{{ $p->waste_reduction }}" data-roi="{{ $p->roi_months }}"
                                    data-downtime="{{ $p->downtime_reduction }}" data-quality="{{ $p->quality_rate }}">
                                    <td class="py-3 pr-3 font-medium text-gray-900">{{ Str::limit($p->title, 25) }}</td>
                                    <td class="py-3 pr-3 text-gray-600">{{ $p->category->name ?? '-' }}</td>
                                    <td class="py-3 pr-3">
                                        @if($p->is_active)
                                            <span
                                                class="inline-flex rounded-full bg-green-100 text-green-700 px-2.5 py-1 text-xs">Aktif</span>
                                        @else
                                            <span
                                                class="inline-flex rounded-full bg-gray-100 text-gray-600 px-2.5 py-1 text-xs">Draft</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-gray-700">
                                        {{ $p->project_date ? $p->project_date->format('d M Y') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr id="projectEmptyRow">
                                    <td colspan="4" class="py-8 text-center text-gray-500">Belum ada proyek.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div id="projectEmpty" class="hidden text-center py-10 text-sm text-gray-500">
                        Proyek tidak ditemukan.
                    </div>
                </div>
            </div>

            {{-- KANAN: FORM TAMBAH / EDIT --}}
            <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
                <div>
                    <h4 id="projFormTitle" class="font-semibold text-gray-900">Tambah Proyek Baru</h4>
                    <p class="text-xs text-gray-500 mt-1">Isi data di bawah lalu simpan.</p>
                </div>

                <form id="projectForm" class="mt-4 space-y-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="projectId" value="" />

                    <div>
                        <label class="text-xs text-gray-500">Judul Proyek <span class="text-red-500">*</span></label>
                        <input id="titleInput" name="title" type="text" required
                            placeholder="Contoh: Integrasi Sistem Otomasi"
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                        <p class="text-xs text-gray-400 mt-1">Maksimal 255 karakter</p>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Subjudul</label>
                        <input id="subtitleInput" name="subtitle" type="text" placeholder="Contoh: Otomasi & IoT"
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                    </div>

                    {{-- <div>
                        <label class="text-xs text-gray-500">Kategori</label>
                        <select id="categoryInput" name="category_id"
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div>
                        <label class="text-xs text-gray-500">Deskripsi Singkat <span
                                class="text-red-500">*</span></label>
                        <textarea id="descriptionInput" name="description" rows="2" required
                            placeholder="Deskripsi singkat untuk preview"
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Detail Proyek</label>
                        <textarea id="detailInput" name="detail" rows="3"
                            placeholder="Jelaskan detail proyek secara lengkap"
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
                    </div>

                    {{-- <div>
                        <label class="text-xs text-gray-500">Tanggal Proyek</label>
                        <input id="dateInput" name="project_date" type="date"
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                    </div> --}}

                    <div>
                        <label class="text-xs text-gray-500">Link YouTube (opsional)</label>
                        <input id="youtubeInput" name="youtube_url" type="url"
                            placeholder="https://www.youtube.com/watch?v=..."
                            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                        <p class="text-xs text-gray-400 mt-1">Masukkan URL YouTube yang valid</p>
                    </div>

                    <div data-field="thumbnail">
                        <div class="text-xs text-gray-500">Thumbnail</div>
                        <div
                            class="h-24 bg-gray-50 rounded-md overflow-hidden mb-2 flex items-center justify-center text-gray-400 preview-area">
                            <span class="preview-placeholder">Preview Gambar</span>
                        </div>
                        <label
                            class="w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                            <span class="text-gray-900/60 text-sm truncate file-name">No file chosen</span>
                            <input id="thumbnailInput" type="file" name="thumbnail" accept="image/*"
                                class="hidden file-input" />
                            <span
                                class="flex w-28 h-9 px-2 bg-secondary rounded-r-lg shadow text-white text-xs font-semibold items-center justify-center">Choose
                                File</span>
                        </label>
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP, SVG. Maks. 2MB</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 text-sm">
                            <input id="featuredInput" name="is_featured" type="checkbox" value="1" class="rounded">
                            Featured
                        </label>
                        <label class="flex items-center gap-2 text-sm">
                            <input id="activeInput" name="is_active" type="checkbox" value="1" checked class="rounded">
                            Aktif
                        </label>
                    </div>

                    {{-- PROJECT METRICS SECTION --}}
                    {{-- <div class="pt-3 mt-3 border-t border-gray-200">
                        <div class="mb-3">
                            <h5 class="font-semibold text-gray-900 text-sm">Statistik Proyek</h5>
                            <p class="text-xs text-gray-500">Opsional. Pencapaian/metrics proyek yang akan ditampilkan.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs text-gray-500">Peningkatan Efisiensi</label>
                                <input id="efficiencyInput" name="efficiency_increase" type="text" placeholder="45%"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Pengurangan Waste</label>
                                <input id="wasteInput" name="waste_reduction" type="text" placeholder="30%"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">ROI dalam</label>
                                <input id="roiInput" name="roi_months" type="text" placeholder="18 Bulan"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Downtime Berkurang</label>
                                <input id="downtimeInput" name="downtime_reduction" type="text" placeholder="60%"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                            </div>
                            <div class="col-span-2">
                                <label class="text-xs text-gray-500">Quality Rate</label>
                                <input id="qualityInput" name="quality_rate" type="text" placeholder="99.7%"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                            </div>
                        </div>
                    </div> --}}

                    {{-- GALERI FOTO - Terintegrasi dalam form --}}
                    <div class="pt-3 mt-3 border-t border-gray-200">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h5 class="font-semibold text-gray-900 text-sm">Galeri Foto Proyek</h5>
                                <p class="text-xs text-gray-500">Opsional. Foto-foto tambahan untuk proyek.</p>
                            </div>
                            <span id="galleryFileCount" class="text-xs text-gray-500">0 foto baru</span>
                        </div>

                        {{-- Existing Gallery Images (only show when editing) --}}
                        <div id="existingGallery" class="grid grid-cols-3 gap-2 mb-3">
                            {{-- Populated by JS when editing --}}
                        </div>

                        {{-- Upload New Gallery Images --}}
                        <div id="galleryPreview"
                            class="min-h-[70px] bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 flex flex-wrap items-start gap-2 p-2">
                            {{-- + Button and previews rendered by JS --}}
                            <label id="addPhotoBtn"
                                class="w-14 h-14 rounded-lg border-2 border-dashed border-gray-300 bg-white flex flex-col items-center justify-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="text-[9px] text-gray-400 group-hover:text-green-500">Tambah</span>
                                <input id="galleryInput" type="file" accept="image/*" multiple class="hidden" />
                            </label>
                        </div>
                        <div class="flex items-center justify-between mt-1">
                            <p class="text-[10px] text-gray-500">Klik + untuk menambah foto galeri.</p>
                            <button type="button" id="clearGalleryBtn"
                                class="hidden text-[10px] text-red-500 hover:text-red-600">Hapus semua</button>
                        </div>
                    </div>

                    {{-- Form Buttons --}}
                    <div class="flex items-center justify-end gap-2 pt-3">
                        <button type="button" id="projResetBtn"
                            class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
                            Reset
                        </button>

                        <button type="button" id="projDeleteBtn"
                            class="hidden rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                            Hapus
                        </button>

                        <button type="submit" id="projSaveBtn"
                            class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                            Simpan Proyek
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- TinyMCE WYSIWYG Editor --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
    // Initialize TinyMCE for description field
    tinymce.init({
        selector: '#descriptionInput',
        height: 250,
        menubar: false,
        plugins: 'lists link autolink',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | removeformat',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.6; }',
        branding: false,
        promotion: false,
        statusbar: false,
        setup: function (editor) {
            editor.on('change blur', function () {
                editor.save();
            });
        }
    });

    // Initialize TinyMCE for detail field
    tinymce.init({
        selector: '#detailInput',
        height: 300,
        menubar: false,
        plugins: 'lists link autolink',
        toolbar: 'undo redo | bold italic underline | bullist numlist | link | removeformat',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.6; }',
        branding: false,
        promotion: false,
        statusbar: false,
        setup: function (editor) {
            editor.on('change blur', function () {
                editor.save();
            });
        }
    });
</script>

<script>
    (function () {
        const csrfToken = '{{ csrf_token() }}';
        const rows = () => Array.from(document.querySelectorAll('.project-row'));

        const form = document.getElementById('projectForm');
        const formTitle = document.getElementById('projFormTitle');
        const idEl = document.getElementById('projectId');
        const titleEl = document.getElementById('titleInput');
        const subtitleEl = document.getElementById('subtitleInput');
        const categoryEl = document.getElementById('categoryInput');
        const descEl = document.getElementById('descriptionInput');
        const detailEl = document.getElementById('detailInput');
        const dateEl = document.getElementById('dateInput');
        const youtubeEl = document.getElementById('youtubeInput');
        const thumbnailEl = document.getElementById('thumbnailInput');
        const featuredEl = document.getElementById('featuredInput');
        const activeEl = document.getElementById('activeInput');
        const previewArea = document.querySelector('[data-field="thumbnail"] .preview-area');

        const searchEl = document.getElementById('projectSearch');
        const emptyEl = document.getElementById('projectEmpty');
        const btnNew = document.getElementById('projNewBtn');
        const btnReset = document.getElementById('projResetBtn');
        const btnDelete = document.getElementById('projDeleteBtn');
        const btnSave = document.getElementById('projSaveBtn');

        function clearActive() {
            rows().forEach(r => r.classList.remove('ring-2', 'ring-green-200', 'bg-green-50'));
        }

        function resetForm() {
            form.reset();
            idEl.value = '';
            formTitle.textContent = 'Tambah Proyek Baru';
            btnDelete.classList.add('hidden');
            activeEl.checked = true;
            if (previewArea) previewArea.innerHTML = '<span class="preview-placeholder">Preview Gambar</span>';
            const fileNameSpan = document.querySelector('[data-field="thumbnail"] .file-name');
            if (fileNameSpan) fileNameSpan.textContent = 'No file chosen';

            // Clear TinyMCE editors
            if (typeof tinymce !== 'undefined') {
                if (tinymce.get('descriptionInput')) {
                    tinymce.get('descriptionInput').setContent('');
                }
                if (tinymce.get('detailInput')) {
                    tinymce.get('detailInput').setContent('');
                }
            }

            clearActive();
        }

        function fillForm(row) {
            idEl.value = row.dataset.id || '';
            formTitle.textContent = 'Edit Proyek';
            titleEl.value = row.dataset.title || '';
            subtitleEl.value = row.dataset.subtitle || '';
            if (categoryEl) categoryEl.value = row.dataset.category || '';

            // Set description in TinyMCE editor
            const descContent = row.dataset.description || '';
            descEl.value = descContent;
            if (typeof tinymce !== 'undefined' && tinymce.get('descriptionInput')) {
                tinymce.get('descriptionInput').setContent(descContent);
            }

            // Set detail in TinyMCE editor
            const detailContent = row.dataset.detail || '';
            detailEl.value = detailContent;
            if (typeof tinymce !== 'undefined' && tinymce.get('detailInput')) {
                tinymce.get('detailInput').setContent(detailContent);
            }

            if (dateEl) dateEl.value = row.dataset.date || '';
            youtubeEl.value = row.dataset.youtube || '';
            featuredEl.checked = row.dataset.featured === '1';
            activeEl.checked = row.dataset.active === '1';
            btnDelete.classList.remove('hidden');

            // Fill metrics fields
            const efficiencyInput = document.getElementById('efficiencyInput');
            const wasteInput = document.getElementById('wasteInput');
            const roiInput = document.getElementById('roiInput');
            const downtimeInput = document.getElementById('downtimeInput');
            const qualityInput = document.getElementById('qualityInput');
            if (efficiencyInput) efficiencyInput.value = row.dataset.efficiency || '';
            if (wasteInput) wasteInput.value = row.dataset.waste || '';
            if (roiInput) roiInput.value = row.dataset.roi || '';
            if (downtimeInput) downtimeInput.value = row.dataset.downtime || '';
            if (qualityInput) qualityInput.value = row.dataset.quality || '';

            if (row.dataset.thumbnail && previewArea) {
                previewArea.innerHTML = `<img src="/storage/${row.dataset.thumbnail}" alt="Thumbnail" class="w-full h-full object-cover cursor-pointer" onclick="openImageModal && openImageModal(this.src, 'Thumbnail')">`;
            } else if (previewArea) {
                previewArea.innerHTML = '<span class="preview-placeholder">Preview Gambar</span>';
            }
        }

        rows().forEach(row => {
            row.addEventListener('click', () => {
                clearActive();
                row.classList.add('ring-2', 'ring-green-200', 'bg-green-50');
                fillForm(row);
            });
        });

        btnNew?.addEventListener('click', resetForm);
        btnReset?.addEventListener('click', resetForm);

        searchEl?.addEventListener('input', () => {
            const q = searchEl.value.toLowerCase().trim();
            let visible = 0;
            rows().forEach(row => {
                const text = (row.dataset.title || '').toLowerCase();
                const show = !q || text.includes(q);
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            emptyEl?.classList.toggle('hidden', visible !== 0);
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = idEl.value;
            const url = id ? `/admin/portfolios/${id}` : '/admin/portfolios';

            setButtonLoading(btnSave, true);

            // Sync TinyMCE content to textarea before form submit
            if (typeof tinymce !== 'undefined') {
                if (tinymce.get('descriptionInput')) {
                    tinymce.get('descriptionInput').save();
                }
                if (tinymce.get('detailInput')) {
                    tinymce.get('detailInput').save();
                }
            }

            const formData = new FormData(form);
            if (id) formData.append('_method', 'PUT');

            try {
                // Step 1: Save portfolio
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData,
                });
                const result = await response.json();

                if (response.ok && result.success) {
                    showToast(result.message || 'Berhasil disimpan', 'success');

                    // Step 2: Upload gallery files if any
                    const portfolioId = id || (result.portfolio?.id);

                    if (galleryFiles.length > 0 && portfolioId) {
                        showToast(`Mengupload ${galleryFiles.length} foto galeri...`, 'info');

                        const galleryFormData = new FormData();
                        galleryFiles.forEach(file => {
                            galleryFormData.append('images[]', file);
                        });

                        try {
                            const galleryResponse = await fetch(`/admin/portfolios/${portfolioId}/images`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: galleryFormData,
                            });
                            const galleryResult = await galleryResponse.json();

                            if (galleryResponse.ok && galleryResult.success) {
                                showToast(galleryResult.message || 'Foto galeri berhasil diupload', 'success');
                            } else {
                                const galleryError = formatApiError(galleryResponse, galleryResult);
                                showToast(galleryError, 'error');
                            }
                        } catch (galleryErr) {
                            console.error('Gallery upload error:', galleryErr);
                            showToast({
                                title: 'Upload Error',
                                message: 'Gagal mengupload foto galeri',
                                details: [`• ${galleryErr.message || 'Network error'}`]
                            }, 'error');
                        }
                    }

                    // Step 3: Reload page after all done
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
                setButtonLoading(btnSave, false);
            }
        });

        btnDelete?.addEventListener('click', async () => {
            const id = idEl.value;
            if (!id) return;
            if (!confirm('Yakin ingin menghapus proyek ini?')) return;

            setButtonLoading(btnDelete, true);

            try {
                const response = await fetch(`/admin/portfolios/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                });
                const result = await response.json();

                if (response.ok && result.success) {
                    showToast(result.message || 'Berhasil dihapus', 'success');
                    setTimeout(() => location.reload(), 1000);
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
                setButtonLoading(btnDelete, false);
            }
        });

        thumbnailEl?.addEventListener('change', function () {
            const fileNameSpan = this.closest('label')?.querySelector('.file-name');
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                if (fileNameSpan) fileNameSpan.textContent = file.name;
                if (previewArea) {
                    const url = URL.createObjectURL(file);
                    previewArea.innerHTML = `<img src="${url}" alt="${file.name}" class="w-full h-full object-cover">`;
                }
            }
        });

        // =====================
        // GALLERY FUNCTIONALITY
        // =====================
        const existingGallery = document.getElementById('existingGallery');
        const galleryPreview = document.getElementById('galleryPreview');
        const galleryInput = document.getElementById('galleryInput');

        let galleryFiles = [];
        let portfolioImages = @json($portfolios->mapWithKeys(function ($p) {
            return [
                (string) $p->id => $p->images->map(function ($img) {
                    return ['id' => $img->id, 'path' => $img->image_path];
                })->values()->toArray()
            ];
        })->toArray());

        // Load existing gallery when editing (called from fillForm)
        function loadExistingGallery(portfolioId) {
            if (!existingGallery) return;

            const images = portfolioImages[portfolioId] || [];
            if (images.length === 0) {
                existingGallery.innerHTML = '';
                return;
            }

            existingGallery.innerHTML = '';
            images.forEach(img => {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative group';
                wrapper.innerHTML = `
                    <img src="/storage/${img.path}" alt="Gallery" class="w-full h-20 object-cover rounded cursor-pointer" onclick="openImageModal && openImageModal(this.src, 'Gallery')">
                    <button type="button" class="delete-gallery-img absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition" data-id="${img.id}">&times;</button>
                `;
                existingGallery.appendChild(wrapper);
            });

            // Add delete handlers
            existingGallery.querySelectorAll('.delete-gallery-img').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.stopPropagation();
                    const imgId = btn.dataset.id;
                    if (!confirm('Hapus foto ini dari galeri?')) return;

                    btn.disabled = true;
                    btn.innerHTML = '...';

                    try {
                        const response = await fetch(`/admin/portfolio-images/${imgId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                        });
                        const result = await response.json();

                        if (response.ok && result.success) {
                            showToast(result.message || 'Foto dihapus', 'success');
                            btn.closest('.relative').remove();
                            // Update local data
                            const pid = idEl.value;
                            if (portfolioImages[pid]) {
                                portfolioImages[pid] = portfolioImages[pid].filter(i => i.id != imgId);
                            }
                        } else {
                            const errorObj = formatApiError(response, result);
                            showToast(errorObj, 'error');
                            btn.disabled = false;
                            btn.innerHTML = '&times;';
                        }
                    } catch (err) {
                        showToast({
                            title: 'Koneksi Error',
                            message: 'Gagal menghapus foto',
                            details: [`• ${err.message || 'Network error'}`]
                        }, 'error');
                        btn.disabled = false;
                        btn.innerHTML = '&times;';
                    }
                });
            });
        }

        function resetGalleryUpload() {
            galleryFiles = [];
            if (galleryInput) galleryInput.value = '';
            updateGalleryUI();
        }

        function updateGalleryUI() {
            const fileCount = document.getElementById('galleryFileCount');
            const clearBtn = document.getElementById('clearGalleryBtn');

            // Update file count
            if (fileCount) {
                fileCount.textContent = `${galleryFiles.length} foto dipilih`;
            }

            // Show/hide clear button and enable/disable upload button
            if (clearBtn) {
                clearBtn.classList.toggle('hidden', galleryFiles.length === 0);
            }
            if (uploadGalleryBtn) {
                uploadGalleryBtn.disabled = galleryFiles.length === 0;
            }
        }

        function renderGalleryPreview() {
            if (!galleryPreview) return;

            // Clear preview but keep the + button
            galleryPreview.innerHTML = '';

            // Re-add the + button first
            const addBtn = document.createElement('label');
            addBtn.id = 'addPhotoBtn';
            addBtn.className = 'w-16 h-16 rounded-lg border-2 border-dashed border-gray-300 bg-white flex flex-col items-center justify-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition group flex-shrink-0';
            addBtn.innerHTML = `
                <svg class="w-6 h-6 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-[10px] text-gray-400 group-hover:text-green-500 mt-1">Tambah</span>
                <input type="file" accept="image/*" multiple class="hidden" />
            `;
            galleryPreview.appendChild(addBtn);

            // Attach event to the new input
            const newInput = addBtn.querySelector('input');
            newInput.addEventListener('change', function () {
                const newFiles = Array.from(this.files || []);
                // Accumulate files instead of replace
                galleryFiles = galleryFiles.concat(newFiles);
                this.value = ''; // Clear input so same files can be added again
                renderGalleryPreview();
                updateGalleryUI();
            });

            // Add preview for each file
            galleryFiles.forEach((file, idx) => {
                const url = URL.createObjectURL(file);
                const wrapper = document.createElement('div');
                wrapper.className = 'relative w-16 h-16 overflow-hidden rounded bg-white flex items-center justify-center border border-gray-100 flex-shrink-0';
                wrapper.innerHTML = `
                    <img src="${url}" alt="${file.name}" class="w-full h-full object-cover">
                    <button type="button" class="remove-preview absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-600" data-idx="${idx}">&times;</button>
                `;
                galleryPreview.appendChild(wrapper);

                // Add remove handler
                wrapper.querySelector('.remove-preview').addEventListener('click', (e) => {
                    e.stopPropagation();
                    URL.revokeObjectURL(url); // Clean up
                    galleryFiles.splice(idx, 1);
                    renderGalleryPreview();
                    updateGalleryUI();
                });
            });

            updateGalleryUI();
        }

        // Clear all button handler
        document.getElementById('clearGalleryBtn')?.addEventListener('click', () => {
            resetGalleryUpload();
            renderGalleryPreview();
        });

        // Initial render on load (for when gallery section becomes visible)
        function initGalleryPreview() {
            renderGalleryPreview();
        }

        galleryInput?.addEventListener('change', function () {
            const newFiles = Array.from(this.files || []);
            galleryFiles = galleryFiles.concat(newFiles);
            this.value = '';
            renderGalleryPreview();
            updateGalleryUI();
        });

        // Update fillForm to load existing gallery when editing
        const originalFillForm = fillForm;
        fillForm = function (row) {
            originalFillForm(row);
            loadExistingGallery(row.dataset.id);
            resetGalleryUpload();
            renderGalleryPreview();
        };

        // Update resetForm to clear gallery
        const originalResetForm = resetForm;
        resetForm = function () {
            originalResetForm();
            if (existingGallery) existingGallery.innerHTML = '';
            resetGalleryUpload();
            renderGalleryPreview();
        };

        // Initialize gallery preview on load
        renderGalleryPreview();
    })();
</script>