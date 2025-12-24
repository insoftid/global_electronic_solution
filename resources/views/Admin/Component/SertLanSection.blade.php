{{-- SERTIFIKASI (partial) --}}
{{-- Uses $certificates from controller --}}
<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mt-6">
    <div class="px-5 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Sertifikasi</h3>
        <p class="text-xs text-gray-500 mt-1">
            Kelola daftar sertifikasi perusahaan. Klik item untuk edit.
        </p>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-12 gap-4">

        {{-- KIRI: DAFTAR --}}
        <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
            <div class="flex items-center justify-between gap-2">
                <div>
                    <h4 class="font-semibold text-gray-900">Daftar Sertifikasi</h4>
                    <p class="text-xs text-gray-500 mt-1">Klik baris untuk edit di kanan.</p>
                </div>

                <div class="flex gap-2">
                    <input id="certSearch" type="text" placeholder="Cari sertifikasi..."
                        class="w-40 sm:w-56 rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
                    <button id="certNewBtn" type="button"
                        class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700 whitespace-nowrap">
                        + Tambah
                    </button>
                </div>
            </div>

            <div class="mt-3 overflow-auto max-h-80">
                <table class="min-w-full text-sm">
                    <thead class="sticky top-0 bg-white">
                        <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
                            <th class="py-3 pr-3">Nama</th>
                            <th class="py-3 pr-3">Status</th>
                            <th class="py-3">Gambar</th>
                        </tr>
                    </thead>

                    <tbody id="certBody">
                        @forelse($certificates ?? [] as $c)
                            <tr class="cert-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                                data-id="{{ $c->id }}" data-name="{{ $c->name }}" data-description="{{ $c->description }}"
                                data-image="{{ $c->image_path }}" data-active="{{ $c->is_active ? 1 : 0 }}">
                                <td class="py-3 pr-3 font-medium text-gray-900">{{ $c->name }}</td>
                                <td class="py-3 pr-3">
                                    @if($c->is_active)
                                        <span
                                            class="inline-flex rounded-full bg-green-100 text-green-700 px-2.5 py-1 text-xs">Aktif</span>
                                    @else
                                        <span
                                            class="inline-flex rounded-full bg-gray-100 text-gray-600 px-2.5 py-1 text-xs">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    @if($c->image_path)
                                        <img src="{{ asset('storage/' . $c->image_path) }}" alt="{{ $c->name }}"
                                            class="h-8 w-12 object-cover rounded cursor-pointer"
                                            onclick="openImageModal && openImageModal(this.src, '{{ $c->name }}')">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="certEmptyRow">
                                <td colspan="3" class="py-8 text-center text-gray-500">Belum ada sertifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div id="certEmpty" class="hidden text-center py-10 text-sm text-gray-500">
                    Sertifikasi tidak ditemukan.
                </div>
            </div>
        </div>

        {{-- KANAN: FORM TAMBAH / EDIT --}}
        <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
            <div>
                <h4 id="certFormTitle" class="font-semibold text-gray-900">Tambah Sertifikasi Baru</h4>
                <p class="text-xs text-gray-500 mt-1">Isi data lalu simpan.</p>
            </div>

            <form id="certForm" class="mt-4 space-y-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="certId" value="" />

                <div>
                    <label class="text-xs text-gray-500">Nama Sertifikasi <span class="text-red-500">*</span></label>
                    <input id="certName" name="name" type="text" required placeholder="Contoh: ISO 9001:2015"
                        class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
                    <p class="text-xs text-gray-400 mt-1">Maksimal 255 karakter</p>
                </div>

                <div>
                    <label class="text-xs text-gray-500">Deskripsi</label>
                    <textarea id="certDesc" name="description" rows="2" placeholder="Deskripsi sertifikasi (opsional)"
                        class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
                </div>

                <div data-field="cert-image">
                    <div class="text-xs text-gray-500">Upload Gambar Sertifikasi</div>
                    <div id="certFilePreview"
                        class="h-24 bg-gray-50 rounded-md overflow-hidden mb-2 flex items-center justify-center text-gray-400 preview-area">
                        <span class="preview-placeholder">Preview Foto</span>
                    </div>
                    <label
                        class="w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                        <span class="text-gray-900/60 text-sm truncate file-name">No file chosen</span>
                        <input id="certFile" type="file" name="image" accept="image/*" class="hidden file-input" />
                        <span
                            class="flex w-28 h-9 px-2 bg-secondary rounded-r-lg shadow text-white text-xs font-semibold items-center justify-center">Choose
                            File</span>
                    </label>
                    <p class="text-[10px] text-gray-500 mt-1">PNG, JPG (Max 2 MB). Wajib untuk sertifikat baru.</p>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm">
                        <input id="certActive" name="is_active" type="checkbox" value="1" checked class="rounded">
                        Aktif
                    </label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" id="certReset"
                        class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
                        Reset
                    </button>

                    <button type="button" id="certDelete"
                        class="hidden rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                        Hapus
                    </button>

                    <button type="submit" id="certSave"
                        class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    (function () {
        const csrfToken = '{{ csrf_token() }}';
        const rows = () => Array.from(document.querySelectorAll('.cert-row'));

        const form = document.getElementById('certForm');
        const formTitle = document.getElementById('certFormTitle');
        const idEl = document.getElementById('certId');
        const nameEl = document.getElementById('certName');
        const descEl = document.getElementById('certDesc');
        const fileEl = document.getElementById('certFile');
        const activeEl = document.getElementById('certActive');
        const previewArea = document.getElementById('certFilePreview');

        const searchEl = document.getElementById('certSearch');
        const emptyEl = document.getElementById('certEmpty');
        const btnNew = document.getElementById('certNewBtn');
        const btnReset = document.getElementById('certReset');
        const btnDelete = document.getElementById('certDelete');
        const btnSave = document.getElementById('certSave');

        function clearActive() {
            rows().forEach(r => r.classList.remove('ring-2', 'ring-green-200', 'bg-green-50'));
        }

        function resetForm() {
            form.reset();
            idEl.value = '';
            formTitle.textContent = 'Tambah Sertifikasi Baru';
            btnDelete.classList.add('hidden');
            activeEl.checked = true;
            if (previewArea) previewArea.innerHTML = '<span class="preview-placeholder">Preview Foto</span>';
            const fileNameSpan = document.querySelector('[data-field="cert-image"] .file-name');
            if (fileNameSpan) fileNameSpan.textContent = 'No file chosen';
            clearActive();
        }

        function fillForm(row) {
            idEl.value = row.dataset.id || '';
            formTitle.textContent = 'Edit Sertifikasi';
            nameEl.value = row.dataset.name || '';
            descEl.value = row.dataset.description || '';
            activeEl.checked = row.dataset.active === '1';
            btnDelete.classList.remove('hidden');

            if (row.dataset.image && previewArea) {
                previewArea.innerHTML = `<img src="/storage/${row.dataset.image}" alt="Certificate" class="w-full h-full object-cover cursor-pointer" onclick="openImageModal && openImageModal(this.src, '${row.dataset.name}')">`;
            } else if (previewArea) {
                previewArea.innerHTML = '<span class="preview-placeholder">Preview Foto</span>';
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
                const text = (row.dataset.name || '').toLowerCase();
                const show = !q || text.includes(q);
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            emptyEl?.classList.toggle('hidden', visible !== 0);
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = idEl.value;
            const url = id ? `/admin/certificates/${id}` : '/admin/certificates';

            setButtonLoading(btnSave, true);

            const formData = new FormData(form);
            if (id) formData.append('_method', 'PUT');

            try {
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
                setButtonLoading(btnSave, false);
            }
        });

        btnDelete?.addEventListener('click', async () => {
            const id = idEl.value;
            if (!id) return;
            if (!confirm('Yakin ingin menghapus sertifikasi ini?')) return;

            setButtonLoading(btnDelete, true);

            try {
                const response = await fetch(`/admin/certificates/${id}`, {
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

        fileEl?.addEventListener('change', function () {
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
    })();
</script>