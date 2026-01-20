{{-- Landing Page Section - Uses dynamic data from controller --}}
{{-- Controller passes: $portfolios, $categories, $tags, $certificates, $partners, $settings --}}

{{-- Section Visibility Controls --}}
<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">Pengaturan Tampilan Section</h3>
        <p class="text-xs text-gray-500 mt-1">
            Aktifkan atau nonaktifkan section yang tampil di landing page.
        </p>
    </div>
    <div class="px-5 py-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Portfolio Section Toggle --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <h4 class="font-medium text-gray-900">Section Proyek</h4>
                    <p class="text-xs text-gray-500">Tampilkan section portfolio/proyek</p>
                </div>
                <label class="relative inline-block w-12 h-7 cursor-pointer">
                    <input type="checkbox" 
                           class="opacity-0 w-0 h-0 section-toggle" 
                           data-section="portfolio"
                           {{ ($settings['section_portfolio_active'] ?? '1') === '1' ? 'checked' : '' }}>
                    <span class="toggle-slider absolute inset-0 bg-gray-300 rounded-full transition-colors duration-200"></span>
                    <span class="toggle-dot absolute left-1 top-1 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200"></span>
                </label>
            </div>

            {{-- Certificate Section Toggle --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <h4 class="font-medium text-gray-900">Section Sertifikat</h4>
                    <p class="text-xs text-gray-500">Tampilkan section sertifikat</p>
                </div>
                <label class="relative inline-block w-12 h-7 cursor-pointer">
                    <input type="checkbox" 
                           class="opacity-0 w-0 h-0 section-toggle" 
                           data-section="certificate"
                           {{ ($settings['section_certificate_active'] ?? '1') === '1' ? 'checked' : '' }}>
                    <span class="toggle-slider absolute inset-0 bg-gray-300 rounded-full transition-colors duration-200"></span>
                    <span class="toggle-dot absolute left-1 top-1 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200"></span>
                </label>
            </div>

            {{-- Partner Section Toggle --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div>
                    <h4 class="font-medium text-gray-900">Section Kerjasama</h4>
                    <p class="text-xs text-gray-500">Tampilkan section partner/kerjasama</p>
                </div>
                <label class="relative inline-block w-12 h-7 cursor-pointer">
                    <input type="checkbox" 
                           class="opacity-0 w-0 h-0 section-toggle" 
                           data-section="partner"
                           {{ ($settings['section_partner_active'] ?? '1') === '1' ? 'checked' : '' }}>
                    <span class="toggle-slider absolute inset-0 bg-gray-300 rounded-full transition-colors duration-200"></span>
                    <span class="toggle-dot absolute left-1 top-1 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200"></span>
                </label>
            </div>
        </div>
    </div>
</div>

<style>
    .section-toggle:checked + .toggle-slider {
        background-color: #16a34a;
    }
    .section-toggle:checked ~ .toggle-dot {
        transform: translateX(20px);
    }
</style>

<script>
    document.querySelectorAll('.section-toggle').forEach(toggle => {
        toggle.addEventListener('change', async function() {
            const section = this.dataset.section;
            const isActive = this.checked ? '1' : '0';
            
            try {
                const response = await fetch('/admin/settings/section-visibility', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        section: section,
                        is_active: isActive
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showToast && showToast(result.message, 'success');
                } else {
                    showToast && showToast(result.message || 'Gagal mengubah pengaturan', 'error');
                    this.checked = !this.checked; // Revert toggle
                }
            } catch (error) {
                console.error('Error:', error);
                showToast && showToast('Gagal menghubungi server', 'error');
                this.checked = !this.checked; // Revert toggle
            }
        });
    });
</script>

@include('Admin.Component.PortLanSection')

@include('Admin.Component.SertLanSection')

@include('Admin.Component.PartLanSection')

{{-- Landing images modal --}}
<div id="image-modal-landing" class="fixed inset-0 z-50 hidden bg-black/70 p-4" aria-hidden="true">
    <div class="flex items-center justify-center w-full h-full">
        <div class="relative max-w-[95%] max-h-[95%]">
            <button id="image-modal-close-landing"
                class="absolute top-2 right-2 bg-black/40 text-white rounded-full py-1 px-3 hover:bg-black/60">&times;</button>
            <img id="image-modal-img-landing" src="" alt="Full preview" class="w-full h-full object-contain rounded" />
        </div>
    </div>
</div>

{{-- Toast Container --}}
<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

<script>
    // Note: showToast and setButtonLoading are already defined globally in Header.blade.php
    // They support both string messages and error objects with detailed field information

    // Image modal handlers
    (function () {
        const modal = document.getElementById('image-modal-landing');
        const modalImg = document.getElementById('image-modal-img-landing');
        const modalClose = document.getElementById('image-modal-close-landing');

        if (!modal || !modalImg || !modalClose) return;

        window.openImageModal = function (src, alt) {
            if (!src) return;
            modalImg.src = src;
            modalImg.alt = alt || '';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        };

        function closeModal() {
            modal.classList.add('hidden');
            modalImg.src = '';
            document.body.style.overflow = '';
        }

        modalClose.addEventListener('click', closeModal);
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>