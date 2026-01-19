@if($portfolio->images && $portfolio->images->count() > 0)
    <section>
        <div class="max-w-6xl mx-auto px-6 pb-20">
            <h2 class="text-3xl font-extrabold text-heading mb-10 text-center">Galeri Proyek</h2>
            <!-- Carousel wrapper -->
            <div class="relative">
                <!-- track viewport -->
                <div id="portfolio-viewport" class="overflow-hidden h-125 p-4 justify-center">
                    <div id="portfolio-track" class="flex items-center gap-5 transition-transform duration-700 ease-in-out">
                        @foreach($portfolio->images as $image)
                            <div class="shrink-0 w-full md:w-1/3 h-115">
                                <div class="h-full flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $portfolio->title }} - Foto {{ $loop->iteration }}"
                                        class="w-full h-full object-cover hover:object-contain transition-all duration-500 rounded-lg cursor-pointer gallery-image"
                                        data-index="{{ $loop->index }}" data-src="{{ asset('storage/' . $image->image_path) }}"
                                        data-alt="{{ $portfolio->title }} - Foto {{ $loop->iteration }}" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- arrows -->
                <button id="porto-prev" aria-label="Previous"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-primary/80 hover:bg-primary shadow rounded-full p-2 z-20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="porto-next" aria-label="Next"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary/80 hover:bg-primary shadow rounded-full p-2 z-20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- autoplay script -->
                <script>
                    (function () {
                        const track = document.getElementById('portfolio-track');
                        if (!track) return;

                        const getSlides = () => Array.from(track.children);
                        const prevBtn = document.getElementById('porto-prev');
                        const nextBtn = document.getElementById('porto-next');
                        const viewport = document.getElementById('portfolio-viewport');

                        let index = 0;
                        let autoplayInterval = null;

                        function visibleCount() {
                            const w = window.innerWidth;
                            if (w >= 768) return 3;
                            if (w >= 640) return 2;
                            return 1;
                        }

                        function updateSizes() {
                            const v = visibleCount();
                            const slides = getSlides();
                            slides.forEach(s => {
                                s.style.flex = `0 0 ${100 / v}%`;
                            });
                            moveTo(index);
                        }

                        function moveTo(i) {
                            const v = visibleCount();
                            const slides = getSlides();
                            const maxIndex = Math.max(0, slides.length - v);
                            if (i < 0) i = maxIndex;
                            if (i > maxIndex) i = 0;
                            index = i;

                            const first = slides[0];
                            if (!first) return;
                            const firstRect = first.getBoundingClientRect();
                            let gap = 0;
                            if (slides.length > 1) {
                                const secondRect = slides[1].getBoundingClientRect();
                                gap = Math.max(0, secondRect.left - firstRect.right);
                            }
                            const step = Math.round(firstRect.width + gap);
                            track.style.transform = `translateX(-${index * step}px)`;
                        }

                        function next() { moveTo(index + 1); }
                        function prev() { moveTo(index - 1); }

                        nextBtn?.addEventListener('click', () => { next(); resetAutoplay(); });
                        prevBtn?.addEventListener('click', () => { prev(); resetAutoplay(); });

                        function startAutoplay() {
                            if (autoplayInterval) clearInterval(autoplayInterval);
                            autoplayInterval = setInterval(() => { next(); }, 3000);
                        }
                        function resetAutoplay() { startAutoplay(); }

                        viewport?.addEventListener('mouseenter', () => { if (autoplayInterval) clearInterval(autoplayInterval); });
                        viewport?.addEventListener('mouseleave', () => { startAutoplay(); });

                        window.addEventListener('resize', updateSizes);
                        updateSizes();
                        setTimeout(() => { startAutoplay(); }, 600);
                    })();
                </script>
            </div>
        </div>

        {{-- Lightbox Modal --}}
        <div id="lightbox-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm">
            {{-- Close Button --}}
            <button id="lightbox-close"
                class="absolute top-4 right-4 z-60 p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all duration-200 group">
                <svg class="w-8 h-8 text-white group-hover:rotate-90 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Previous Button --}}
            <button id="lightbox-prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-60 p-3 rounded-full bg-white/10 hover:bg-white/20 transition-all duration-200 group">
                <svg class="w-6 h-6 text-white group-hover:-translate-x-1 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            {{-- Next Button --}}
            <button id="lightbox-next"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-60 p-3 rounded-full bg-white/10 hover:bg-white/20 transition-all duration-200 group">
                <svg class="w-6 h-6 text-white group-hover:translate-x-1 transition-transform duration-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Image Container --}}
            <div class="relative max-w-7xl max-h-[90vh] mx-auto px-4">
                <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">

                {{-- Image Caption --}}
                <div class="text-center mt-4">
                    <p id="lightbox-caption" class="text-white text-lg font-medium"></p>
                    <p id="lightbox-counter" class="text-white/60 text-sm mt-1"></p>
                </div>
            </div>
        </div>

        {{-- Lightbox Script --}}
        <script>
            (function () {
                const modal = document.getElementById('lightbox-modal');
                const lightboxImage = document.getElementById('lightbox-image');
                const lightboxCaption = document.getElementById('lightbox-caption');
                const lightboxCounter = document.getElementById('lightbox-counter');
                const closeBtn = document.getElementById('lightbox-close');
                const prevBtn = document.getElementById('lightbox-prev');
                const nextBtn = document.getElementById('lightbox-next');
                const galleryImages = document.querySelectorAll('.gallery-image');

                let currentIndex = 0;
                const images = Array.from(galleryImages).map(img => ({
                    src: img.dataset.src,
                    alt: img.dataset.alt
                }));

                function openLightbox(index) {
                    currentIndex = index;
                    updateLightboxImage();
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';

                    // Add fade-in animation
                    setTimeout(() => {
                        modal.style.opacity = '1';
                    }, 10);
                }

                function closeLightbox() {
                    modal.style.opacity = '0';
                    setTimeout(() => {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                        document.body.style.overflow = '';
                    }, 200);
                }

                function updateLightboxImage() {
                    if (images.length === 0) return;

                    const currentImage = images[currentIndex];
                    lightboxImage.src = currentImage.src;
                    lightboxImage.alt = currentImage.alt;
                    lightboxCaption.textContent = currentImage.alt;
                    lightboxCounter.textContent = `${currentIndex + 1} / ${images.length}`;

                    // Add loading animation
                    lightboxImage.style.opacity = '0';
                    lightboxImage.onload = () => {
                        setTimeout(() => {
                            lightboxImage.style.opacity = '1';
                        }, 50);
                    };
                }

                function showNext() {
                    currentIndex = (currentIndex + 1) % images.length;
                    updateLightboxImage();
                }

                function showPrev() {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    updateLightboxImage();
                }

                // Event Listeners
                galleryImages.forEach((img, index) => {
                    img.addEventListener('click', () => openLightbox(index));
                });

                closeBtn?.addEventListener('click', closeLightbox);
                prevBtn?.addEventListener('click', showPrev);
                nextBtn?.addEventListener('click', showNext);

                // Close on backdrop click
                modal?.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeLightbox();
                    }
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (!modal.classList.contains('hidden')) {
                        if (e.key === 'Escape') closeLightbox();
                        if (e.key === 'ArrowRight') showNext();
                        if (e.key === 'ArrowLeft') showPrev();
                    }
                });

                // Add transition styles
                modal.style.transition = 'opacity 0.2s ease';
                lightboxImage.style.transition = 'opacity 0.3s ease';
            })();
        </script>
    </section>
@endif