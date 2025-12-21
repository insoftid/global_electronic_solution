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
    // Global toast function
    window.showToast = function (message, type = 'success', duration = 4000) {
        const container = document.getElementById('toast-container');
        if (!container) return;
        const toast = document.createElement('div');

        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
        const icon = type === 'success'
            ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
            : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

        toast.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-3 transform translate-x-full transition-transform duration-300 max-w-sm`;
        toast.innerHTML = `
        <span class="flex-shrink-0">${icon}</span>
        <span class="flex-1 text-sm font-medium">${message}</span>
        <button class="flex-shrink-0 hover:opacity-80" onclick="this.parentElement.remove()">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    `;

        container.appendChild(toast);
        requestAnimationFrame(() => {
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
        });

        if (type !== 'loading') {
            setTimeout(() => {
                toast.classList.remove('translate-x-0');
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }

        return toast;
    };

    // Global setButtonLoading function
    window.setButtonLoading = function (button, isLoading) {
        if (isLoading) {
            button.disabled = true;
            button.dataset.originalText = button.innerHTML;
            button.innerHTML = `
            <svg class="animate-spin h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Menyimpan...
        `;
            button.classList.add('opacity-70', 'cursor-not-allowed');
        } else {
            button.disabled = false;
            button.innerHTML = button.dataset.originalText || 'Simpan';
            button.classList.remove('opacity-70', 'cursor-not-allowed');
        }
    };

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