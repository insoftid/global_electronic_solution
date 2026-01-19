{{-- Landing Page Section - Uses dynamic data from controller --}}
{{-- Controller passes: $portfolios, $categories, $tags, $certificates, $partners --}}

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