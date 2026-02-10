@php
    $variants = $portfolio->variants ?? collect();

    // Build slides: one cover per variant (first image), each holding its own gallery set.
    $variantSlides = $variants
        ->filter(fn($v) => ($v->images && $v->images->count() > 0) || !empty($v->thumbnail_image))
        ->values()
        ->map(function ($variant) use ($portfolio) {
            $images = $variant->images->map(fn($img) => [
                'type' => ($img->media_type ?? 'image') === 'video' ? 'video' : 'image',
                'src' => asset('storage/' . (($img->media_type ?? 'image') === 'video' ? ($img->media_path ?? $img->image_path) : $img->image_path)),
                'alt' => $portfolio->title . ' - ' . ($variant->name ?? 'Varian'),
            ]);

            $coverPath = $variant->thumbnail_image
                ? asset('storage/' . $variant->thumbnail_image)
                : ($images->first()['src'] ?? null);

            if ($images->isEmpty() && $coverPath) {
                $images = collect([
                    [
                        'type' => 'image',
                        'src' => $coverPath,
                        'alt' => $portfolio->title . ' - ' . ($variant->name ?? 'Varian'),
                    ],
                ]);
            }

            return [
                'name' => $variant->name ?? 'Varian',
                'cover' => $coverPath,
                'images' => $images,
            ];
        });

    $slides = $variantSlides;
    $hasSlides = $slides->count() > 0;
@endphp

@if($hasSlides)
    <section>
        <div class="max-w-6xl mx-auto px-6 pb-20">
            <h2 class="text-3xl font-extrabold text-heading mb-10 text-center">Galeri Produk</h2>

            <!-- Carousel wrapper -->
            <div class="relative">
                <!-- track viewport -->
                <div id="portfolio-viewport" class="overflow-hidden h-125 p-4 justify-center">
                    <div id="portfolio-track" class="flex items-center gap-5 transition-transform duration-700 ease-in-out">
                        @foreach($slides as $idx => $slide)
                            @if($slide['cover'])
                                <div class="shrink-0 w-full md:w-1/3 h-115">
                                    <div class="h-full relative rounded-lg overflow-hidden group cursor-pointer gallery-image" data-variant-index="{{ $idx }}">
                                        <img src="{{ $slide['cover'] }}"
                                            alt="{{ $portfolio->title }} - {{ $slide['name'] }}"
                                            class="w-full h-full object-cover transition-all duration-500" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    </div>
                                </div>
                            @endif
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
                <video id="lightbox-video" class="hidden max-w-full max-h-[85vh] rounded-lg shadow-2xl" controls playsinline></video>

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
                const lightboxVideo = document.getElementById('lightbox-video');
                const lightboxCaption = document.getElementById('lightbox-caption');
                const lightboxCounter = document.getElementById('lightbox-counter');
                const closeBtn = document.getElementById('lightbox-close');
                const prevBtn = document.getElementById('lightbox-prev');
                const nextBtn = document.getElementById('lightbox-next');
                const galleryImages = document.querySelectorAll('.gallery-image');

                const slides = @json($slides->values());
                let currentVariant = 0;
                let currentIndex = 0;

                function openLightbox(variantIdx) {
                    currentVariant = variantIdx;
                    currentIndex = 0;
                    updateLightboxImage();
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';

                    setTimeout(() => { modal.style.opacity = '1'; }, 10);
                }

                function closeLightbox() {
                    modal.style.opacity = '0';
                    setTimeout(() => {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                        document.body.style.overflow = '';
                        lightboxVideo.pause();
                    }, 200);
                }

                function activeImages() {
                    return slides[currentVariant]?.images || [];
                }

                function updateLightboxImage() {
                    const imgs = activeImages();
                    if (!imgs.length) return;

                    const currentImage = imgs[currentIndex];
                    if (currentImage.type === 'video') {
                        lightboxImage.classList.add('hidden');
                        lightboxVideo.classList.remove('hidden');
                        lightboxVideo.src = currentImage.src;
                        lightboxVideo.load();
                    } else {
                        lightboxVideo.pause();
                        lightboxVideo.classList.add('hidden');
                        lightboxImage.classList.remove('hidden');
                        lightboxImage.src = currentImage.src;
                        lightboxImage.alt = currentImage.alt;
                    }
                    lightboxCaption.textContent = (slides[currentVariant]?.name || 'Galeri') + ' – ' + (currentImage.alt || '');
                    lightboxCounter.textContent = `${currentIndex + 1} / ${imgs.length}`;

                    if (currentImage.type !== 'video') {
                        lightboxImage.style.opacity = '0';
                        lightboxImage.onload = () => {
                            setTimeout(() => { lightboxImage.style.opacity = '1'; }, 50);
                        };
                    }
                }

                function showNext() {
                    const imgs = activeImages();
                    if (!imgs.length) return;
                    currentIndex = (currentIndex + 1) % imgs.length;
                    updateLightboxImage();
                }

                function showPrev() {
                    const imgs = activeImages();
                    if (!imgs.length) return;
                    currentIndex = (currentIndex - 1 + imgs.length) % imgs.length;
                    updateLightboxImage();
                }

                galleryImages.forEach((img) => {
                    img.addEventListener('click', () => {
                        const variantIdx = parseInt(img.dataset.variantIndex, 10);
                        if (isNaN(variantIdx)) return;
                        openLightbox(variantIdx);
                    });
                });

                closeBtn?.addEventListener('click', closeLightbox);
                prevBtn?.addEventListener('click', showPrev);
                nextBtn?.addEventListener('click', showNext);

                modal?.addEventListener('click', (e) => { if (e.target === modal) closeLightbox(); });

                document.addEventListener('keydown', (e) => {
                    if (!modal.classList.contains('hidden')) {
                        if (e.key === 'Escape') closeLightbox();
                        if (e.key === 'ArrowRight') showNext();
                        if (e.key === 'ArrowLeft') showPrev();
                    }
                });

                modal.style.transition = 'opacity 0.2s ease';
                lightboxImage.style.transition = 'opacity 0.3s ease';
            })();
        </script>
    </section>
@endif