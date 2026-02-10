{{-- PROYEK / PORTFOLIO (partial) --}}
{{-- Uses $portfolios and $categories from controller --}}
<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Produk / Portfolio</h3>
        <p class="text-xs text-gray-500 mt-1">
            Kelola daftar produk yang tampil di landing page. Klik item untuk edit.
        </p>
    </div>

    <div class="px-5 py-5 space-y-4">
        {{-- GRID KIRI-KANAN --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

            {{-- KIRI: DAFTAR PROYEK --}}
            <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-900">Daftar Produk</h4>
                        <p class="text-xs text-gray-500 mt-1">Pilih produk untuk edit detail di kanan.</p>
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

                <div class="mt-4 space-y-3 max-h-[26rem] overflow-auto" id="projectBody">
                    @forelse($portfolios ?? [] as $p)
                        <div class="project-row cursor-pointer border border-gray-100 rounded-2xl p-4 hover:border-green-200 hover:shadow-sm transition"
                            data-id="{{ $p->id }}" data-title="{{ $p->title }}" data-subtitle="{{ $p->subtitle }}"
                            data-description="{{ $p->description }}" data-detail="{{ $p->detail }}"
                            data-category="{{ $p->category_id }}" data-youtube="{{ $p->youtube_url }}"
                            data-date="{{ $p->project_date ? $p->project_date->format('Y-m-d') : '' }}"
                            data-featured="{{ $p->is_featured ? 1 : 0 }}" data-active="{{ $p->is_active ? 1 : 0 }}"
                            data-thumbnail="{{ $p->thumbnail }}" data-efficiency="{{ $p->efficiency_increase }}"
                            data-waste="{{ $p->waste_reduction }}" data-roi="{{ $p->roi_months }}"
                            data-downtime="{{ $p->downtime_reduction }}" data-quality="{{ $p->quality_rate }}">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $p->title }}</p>
                                </div>
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $p->is_active ? 'Aktif' : 'Draft' }}
                                </span>
                            </div>
                            <div class="mt-3 text-xs text-gray-500">
                                <span>{{ Str::limit($p->subtitle ?? '', 60) }}</span>
                            </div>
                        </div>
                    @empty
                        <div id="projectEmptyRow" class="py-10 text-center text-sm text-gray-500">
                            Belum ada produk.
                        </div>
                    @endforelse
                </div>

                <div id="projectEmpty" class="hidden text-center py-10 text-sm text-gray-500">
                    Produk tidak ditemukan.
                </div>
            </div>

            {{-- KANAN: FORM TAMBAH / EDIT --}}
            <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
                <div>
                    <h4 id="projFormTitle" class="font-semibold text-gray-900">Tambah Produk Baru</h4>
                    <p class="text-xs text-gray-500 mt-1">Isi data di bawah lalu simpan.</p>
                </div>

                <form id="projectForm" class="mt-4 space-y-4" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="projectId" value="" />

                    <div class="space-y-4">
                        <div class="rounded-2xl border border-gray-100 bg-gray-50/70 p-3 space-y-3">
                            <div class="flex items-center justify-between">
                                <h5 class="text-sm font-semibold text-gray-800">Informasi Utama</h5>
                                <span class="text-[11px] text-gray-400">Wajib</span>
                            </div>

                            <div>
                                <label class="text-xs text-gray-500">Judul Produk <span class="text-red-500">*</span></label>
                                <input id="titleInput" name="title" type="text" required
                                    placeholder="Contoh: Integrasi Sistem Otomasi"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                            </div>

                            <div>
                                <label class="text-xs text-gray-500">Subjudul</label>
                                <input id="subtitleInput" name="subtitle" type="text" placeholder="Contoh: Otomasi & IoT"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                            </div>

                            <div>
                                <label class="text-xs text-gray-500">Deskripsi Singkat <span class="text-red-500">*</span></label>
                                <textarea id="descriptionInput" name="description" rows="2" required
                                    placeholder="Deskripsi singkat untuk preview"
                                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
                            </div>
                        </div>

                        <details class="rounded-2xl border border-gray-100 bg-white p-3 group">
                            <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-gray-800">
                                Detail & Media Tambahan
                                <span class="text-xs text-gray-400 group-open:hidden">Buka</span>
                                <span class="text-xs text-gray-400 hidden group-open:inline">Tutup</span>
                            </summary>
                            <div class="mt-3 space-y-3">
                                <div>
                                    <label class="text-xs text-gray-500">Detail Produk</label>
                                    <textarea id="detailInput" name="detail" rows="3"
                                        placeholder="Jelaskan detail produk secara lengkap"
                                        class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500">Link YouTube (opsional)</label>
                                    <input id="youtubeInput" name="youtube_url" type="url"
                                        placeholder="https://www.youtube.com/watch?v=..."
                                        class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
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
                            </div>
                        </details>
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

                    {{-- VARIAN PROYEK --}}
                    <div class="pt-4 mt-4 border-t border-gray-200" id="variantSection">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h5 class="font-semibold text-gray-900 text-sm">Varian / Tipe Produk</h5>
                                <p class="text-xs text-gray-500">Tambah tipe dan kelola media di bawah ini.</p>
                            </div>
                            <button type="button" id="variantNewBtn"
                                class="rounded-full bg-slate-100 text-gray-700 px-3 py-1 text-xs hover:bg-slate-200">+ Varian baru</button>
                        </div>

                        <div class="grid grid-cols-1 gap-3 lg:grid-cols-2">
                            {{-- List & selector --}}
                            <div class="border border-gray-200 rounded-xl p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <h6 class="font-semibold text-gray-800 text-sm">Daftar Varian</h6>
                                    <span class="text-[11px] text-gray-500" id="variantCount">0 varian</span>
                                </div>
                                <div id="variantList" class="space-y-2 max-h-60 overflow-auto">
                                    <p class="text-xs text-gray-400">Pilih produk untuk melihat varian.</p>
                                </div>
                            </div>

                            {{-- Form varian --}}
                            <div class="border border-gray-200 rounded-xl p-3">
                                <h6 class="font-semibold text-gray-800 text-sm" id="variantFormTitle">Tambah Varian</h6>
                                <p class="text-[11px] text-gray-500 mb-2">Nama dan deskripsi singkat tipe.</p>
                                <div id="variantForm" class="space-y-2" role="form">
                                    <input type="hidden" id="variantId" />
                                    <div>
                                        <label class="text-xs text-gray-500">Nama Varian</label>
                                        <input type="text" id="variantName" class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" placeholder="Contoh: Tipe A" />
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500">Slug (opsional)</label>
                                        <input type="text" id="variantSlug" class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" placeholder="slug-tipe-a" />
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500">Deskripsi</label>
                                        <textarea id="variantDescription" rows="2" class="mt-1 w-full rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" placeholder="Ringkas tipe ini"></textarea>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm">
                                        <label class="flex items-center gap-2"><input type="checkbox" id="variantActive" class="rounded" checked> Aktif</label>
                                    </div>
                                    <div class="flex items-center justify-end gap-2 pt-1">
                                        <button type="button" id="variantDeleteBtn" class="hidden rounded-full border border-red-200 bg-red-50 px-3 py-1 text-xs text-red-700 hover:bg-red-100">Hapus</button>
                                        <button type="button" id="variantSaveBtn" class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">Simpan Varian</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Upload & list images for selected variant --}}
                        <div class="border border-gray-200 rounded-xl p-3 mt-3">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h6 class="font-semibold text-gray-800 text-sm">Media Varian Terpilih</h6>
                                    <p class="text-[11px] text-gray-500" id="variantImageHint">Pilih varian untuk mengelola media.</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <label class="cursor-pointer text-xs bg-slate-100 hover:bg-slate-200 text-gray-700 rounded-full px-3 py-1 flex items-center gap-1">
                                        <input type="file" id="variantImageInput" class="hidden" accept="image/*,video/*" multiple />
                                        <span>+ Tambah Media</span>
                                    </label>
                                    <button type="button" id="variantUploadBtn" class="text-xs bg-green-600 text-white px-3 py-1 rounded-full hover:bg-green-700" disabled>Upload</button>
                                </div>
                            </div>
                            <div id="variantImages" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2"></div>
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
                            Simpan Produk
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
            formTitle.textContent = 'Tambah Produk Baru';
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
            formTitle.textContent = 'Edit Produk';
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

                    // Reload page after all done
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
            if (!confirm('Yakin ingin menghapus produk ini?')) return;

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
        // VARIANT MANAGEMENT
        // =====================
        const variantList = document.getElementById('variantList');
        const variantCount = document.getElementById('variantCount');
    const variantForm = document.getElementById('variantForm');
        const variantFormTitle = document.getElementById('variantFormTitle');
        const variantId = document.getElementById('variantId');
        const variantName = document.getElementById('variantName');
        const variantSlug = document.getElementById('variantSlug');
        const variantDescription = document.getElementById('variantDescription');
        const variantActive = document.getElementById('variantActive');
        const variantDeleteBtn = document.getElementById('variantDeleteBtn');
        const variantNewBtn = document.getElementById('variantNewBtn');
    const variantSaveBtn = document.getElementById('variantSaveBtn');
        const variantUploadBtn = document.getElementById('variantUploadBtn');
        const variantImageInput = document.getElementById('variantImageInput');
        const variantImages = document.getElementById('variantImages');
        const variantImageHint = document.getElementById('variantImageHint');

        let currentPortfolioId = null;
        let currentVariantId = null;
        let variantPendingFiles = [];

        @php
            $variantsJson = $portfolios->mapWithKeys(function ($p) {
                return [
                    (string) $p->id => $p->variants->map(function ($v) {
                        return [
                            'id' => $v->id,
                            'name' => $v->name,
                            'slug' => $v->slug,
                            'description' => $v->description,
                            'is_active' => (bool) $v->is_active,
                            'images' => $v->images->map(function ($img) {
                                return [
                                    'id' => $img->id,
                                    'path' => $img->media_type === 'video' ? $img->media_path : $img->image_path,
                                    'media_type' => $img->media_type ?? 'image',
                                ];
                            })->values()->toArray(),
                        ];
                    })->values()->toArray(),
                ];
            })->toArray();
        @endphp
        let variantsData = @json($variantsJson);

        function resetVariantForm() {
            if (!variantForm) return;
            variantId.value = '';
            variantName.value = '';
            variantSlug.value = '';
            variantDescription.value = '';
            variantActive.checked = true;
            variantFormTitle.textContent = 'Tambah Varian';
            variantDeleteBtn?.classList.add('hidden');
            currentVariantId = null;
            variantPendingFiles = [];
            if (variantImageInput) variantImageInput.value = '';
            renderVariantImages();
            updateVariantUploadState();
        }

        function renderVariantList(portfolioId) {
            if (!variantList) return;
            const list = variantsData[portfolioId] || [];
            variantList.innerHTML = '';
            variantCount.textContent = `${list.length} varian`;

            if (list.length === 0) {
                variantList.innerHTML = '<p class="text-xs text-gray-400">Belum ada varian. Tambah varian baru.</p>';
                return;
            }

            list.forEach((v) => {
                const item = document.createElement('div');
                item.className = 'border border-gray-200 rounded-lg px-3 py-2 flex items-start justify-between hover:border-green-200 cursor-pointer';
                item.innerHTML = `
                    <div>
                        <p class="text-sm font-semibold text-gray-800">${v.name || 'Tanpa nama'}</p>
                        <p class="text-[11px] text-gray-500">${v.description ? v.description.substring(0, 80) : ''}</p>
                        <span class="inline-flex mt-1 rounded-full px-2 py-0.5 text-[11px] ${v.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'}">${v.is_active ? 'Aktif' : 'Nonaktif'}</span>
                    </div>
                    <button type="button" class="text-xs text-primary hover:underline" data-id="${v.id}">Kelola</button>
                `;
                item.querySelector('button')?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    selectVariant(v.id);
                });
                item.addEventListener('click', () => selectVariant(v.id));
                variantList.appendChild(item);
            });
        }

        function selectVariant(id) {
            if (!currentPortfolioId) return;
            const list = variantsData[currentPortfolioId] || [];
            const variant = list.find(v => v.id == id);
            if (!variant) return;

            currentVariantId = variant.id;
            variantId.value = variant.id;
            variantName.value = variant.name || '';
            variantSlug.value = variant.slug || '';
            variantDescription.value = variant.description || '';
            variantActive.checked = !!variant.is_active;
            variantFormTitle.textContent = 'Edit Varian';
            variantDeleteBtn?.classList.remove('hidden');
            variantPendingFiles = [];
            if (variantImageInput) variantImageInput.value = '';
            renderVariantImages();
            updateVariantUploadState();
        }

        function renderVariantImages() {
            if (!variantImages) return;
            variantImages.innerHTML = '';

            if (!currentVariantId) {
                variantImageHint.textContent = 'Pilih varian untuk mengelola media.';
                return;
            }

            variantImageHint.textContent = 'Unggah atau hapus media khusus varian ini.';
            const list = variantsData[currentPortfolioId]?.find(v => v.id == currentVariantId)?.images || [];
            if (list.length === 0) {
                variantImages.innerHTML = '<p class="text-xs text-gray-400">Belum ada foto untuk varian ini.</p>';
                return;
            }

            list.forEach(img => {
                const wrap = document.createElement('div');
                wrap.className = 'relative group';
                const isVideo = img.media_type === 'video';
                const mediaTag = isVideo
                    ? `<video src="/storage/${img.path}" class="w-full h-24 object-cover rounded" muted playsinline></video>`
                    : `<img src="/storage/${img.path}" class="w-full h-24 object-cover rounded" alt="${img.path}">`;

                wrap.innerHTML = `
                    ${mediaTag}
                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition" data-id="${img.id}">&times;</button>
                `;
                wrap.querySelector('button')?.addEventListener('click', () => deleteVariantImage(img.id));
                variantImages.appendChild(wrap);
            });
        }

        async function deleteVariantImage(imageId) {
            if (!confirm('Hapus foto varian ini?')) return;
            try {
                const response = await fetch(`/admin/variant-images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                });
                const result = await response.json();
                if (response.ok && result.success) {
                    showToast(result.message || 'Foto varian dihapus', 'success');
                    // remove locally
                    const list = variantsData[currentPortfolioId] || [];
                    const target = list.find(v => v.id == currentVariantId);
                    if (target) {
                        target.images = target.images.filter(img => img.id != imageId);
                    }
                    renderVariantImages();
                } else {
                    const errorObj = formatApiError(response, result);
                    showToast(errorObj, 'error');
                }
            } catch (err) {
                showToast({ title: 'Koneksi Error', message: 'Gagal menghapus foto varian', details: [`• ${err.message || 'Network error'}`]}, 'error');
            }
        }

        function updateVariantUploadState() {
            if (variantUploadBtn) variantUploadBtn.disabled = !currentVariantId || variantPendingFiles.length === 0;
        }

        variantImageInput?.addEventListener('change', function () {
            const files = Array.from(this.files || []);
            if (files.length) {
                variantPendingFiles = variantPendingFiles.concat(files);
                showToast(`${variantPendingFiles.length} file siap diupload`, 'info');
                updateVariantUploadState();
            }
        });

        variantUploadBtn?.addEventListener('click', async () => {
            if (!currentVariantId || variantPendingFiles.length === 0) return;
            const formData = new FormData();
            variantPendingFiles.forEach(f => formData.append('images[]', f));

            variantUploadBtn.disabled = true;
            variantUploadBtn.textContent = 'Uploading...';

            try {
                const response = await fetch(`/admin/variants/${currentVariantId}/images`, {
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
                    showToast(result.message || 'Foto varian diupload', 'success');
                    const list = variantsData[currentPortfolioId] || [];
                    const target = list.find(v => v.id == currentVariantId);
                    if (target) {
                        const added = (result.images || []).map(img => ({
                            id: img.id,
                            path: img.media_type === 'video' ? (img.media_path || img.path) : (img.image_path || img.path),
                            media_type: img.media_type || 'image'
                        }));
                        target.images = (target.images || []).concat(added);
                    }
                    variantPendingFiles = [];
                    variantImageInput.value = '';
                    renderVariantImages();
                } else {
                    const errorObj = formatApiError(response, result);
                    showToast(errorObj, 'error');
                }
            } catch (err) {
                showToast({ title: 'Upload Error', message: 'Gagal mengupload foto varian', details: [`• ${err.message || 'Network error'}`]}, 'error');
            } finally {
                variantUploadBtn.disabled = false;
                variantUploadBtn.textContent = 'Upload';
                updateVariantUploadState();
            }
        });

        variantNewBtn?.addEventListener('click', resetVariantForm);

        variantDeleteBtn?.addEventListener('click', async () => {
            if (!currentVariantId) return;
            if (!confirm('Hapus varian ini beserta fotonya?')) return;

            setButtonLoading(variantDeleteBtn, true);
            try {
                const response = await fetch(`/admin/variants/${currentVariantId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                });
                const result = await response.json();
                if (response.ok && result.success) {
                    showToast(result.message || 'Varian dihapus', 'success');
                    variantsData[currentPortfolioId] = (variantsData[currentPortfolioId] || []).filter(v => v.id != currentVariantId);
                    resetVariantForm();
                    renderVariantList(currentPortfolioId);
                } else {
                    const errorObj = formatApiError(response, result);
                    showToast(errorObj, 'error');
                }
            } catch (err) {
                showToast({ title: 'Koneksi Error', message: 'Gagal menghapus varian', details: [`• ${err.message || 'Network error'}`]}, 'error');
            } finally {
                setButtonLoading(variantDeleteBtn, false);
            }
        });

        async function handleVariantSave() {
            if (!currentPortfolioId) {
                showToast({ title: 'Pilih Produk', message: 'Pilih produk terlebih dahulu sebelum menambah varian.' }, 'error');
                return;
            }

            const isUpdate = !!variantId.value;
            const url = isUpdate ? `/admin/variants/${variantId.value}` : `/admin/portfolios/${currentPortfolioId}/variants`;
            const payload = {
                name: variantName.value,
                slug: variantSlug.value,
                description: variantDescription.value,
                is_active: variantActive.checked ? 1 : 0,
            };

            setButtonLoading(variantSaveBtn, true);

            try {
                const response = await fetch(url, {
                    method: isUpdate ? 'PUT' : 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(payload),
                });
                const result = await response.json();
                if (response.ok && result.success) {
                    showToast(result.message || 'Varian disimpan', 'success');
                    if (!variantsData[currentPortfolioId]) variantsData[currentPortfolioId] = [];

                    if (isUpdate) {
                        const serverVariant = result.variant || {};
                        variantsData[currentPortfolioId] = variantsData[currentPortfolioId].map(v => v.id == variantId.value ? { ...v, ...payload, ...serverVariant, slug: serverVariant.slug ?? payload.slug } : v);
                    } else {
                        const serverVariant = result.variant || {};
                        const newVariantId = serverVariant.id || variantId.value || Date.now();
                        variantsData[currentPortfolioId].push({ ...payload, ...serverVariant, id: newVariantId, slug: serverVariant.slug ?? payload.slug, images: [] });
                    }

                    renderVariantList(currentPortfolioId);
                    if (isUpdate) {
                        selectVariant(result.variant?.id || variantId.value);
                    } else {
                        selectVariant(result.variant?.id || variantsData[currentPortfolioId].slice(-1)[0]?.id);
                    }
                } else {
                    const errorObj = formatApiError(response, result);
                    showToast(errorObj, 'error');
                }
            } catch (err) {
                showToast({ title: 'Koneksi Error', message: 'Gagal menyimpan varian', details: [`• ${err.message || 'Network error'}`]}, 'error');
            } finally {
                setButtonLoading(variantSaveBtn, false);
            }
        }

        variantSaveBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            handleVariantSave();
        });

        // Extend fill/reset to include variants
        const originalFillFormWithGallery = fillForm;
        fillForm = function (row) {
            originalFillFormWithGallery(row);
            currentPortfolioId = row.dataset.id;
            resetVariantForm();
            renderVariantList(currentPortfolioId);
        };

        const originalResetFormWithGallery = resetForm;
        resetForm = function () {
            originalResetFormWithGallery();
            currentPortfolioId = null;
            resetVariantForm();
            if (variantList) {
                variantList.innerHTML = '<p class="text-xs text-gray-400">Pilih Produk untuk melihat varian.</p>';
                variantCount.textContent = '0 varian';
            }
        };

        // Initialize default state
        updateVariantUploadState();

        // Auto-select first project so variants are visible without extra clicks
        if (!idEl.value && rows().length > 0) {
            const firstRow = rows()[0];
            clearActive();
            firstRow.classList.add('ring-2', 'ring-green-200', 'bg-green-50');
            fillForm(firstRow);
        }

    })();
</script>