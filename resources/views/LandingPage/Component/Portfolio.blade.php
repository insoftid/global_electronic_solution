<section>
    <div class="max-w-6xl mx-auto px-6 pb-20">
        <h2 class="text-3xl font-extrabold text-heading mb-10 text-center">Produk & Proyek Kami</h2>
        
        <div class="relative">
            <div id="portfolio-viewport" class="overflow-hidden h-auto p-4 justify-center">
                <div id="portfolio-track" class="flex items-center gap-5 transition-transform duration-700 ease-in-out">
                    @forelse($portfolios as $portfolio)
                        <div class="shrink-0 w-full md:w-1/3">
                            <a href="{{ route('portfolio.show', $portfolio->slug) }}">
                                <div class="bg-white min-h-[450px] rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300 ease-in-out">
                                    <div class="relative">
                                        <img src="{{ $portfolio->thumbnail ? asset('storage/' . $portfolio->thumbnail) : asset('img/porto.png') }}" 
                                             alt="{{ $portfolio->title }}"
                                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300 ease-in-out" />
                                    </div>
                                    
                                    <div class="p-6">
                                        @if($portfolio->category)
                                            <span class="bg-primary/20 text-primary text-xs font-medium px-3 py-1 rounded-full">{{ $portfolio->category->name }}</span>
                                        @endif
                                        
                                        <div class="flex items-start justify-between gap-4 mt-4">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $portfolio->title }}</h3>
                                                @if($portfolio->subtitle)
                                                    <div class="text-sm text-primary font-medium">{{ $portfolio->subtitle }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <p class="text-sm text-gray-600 mt-4 mb-4">{{ Str::limit($portfolio->description, 100) }}</p>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                @foreach($portfolio->tags as $tag)
                                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-md">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="w-full text-center py-10 text-gray-500">
                            Belum ada portfolio yang ditampilkan.
                        </div>
                    @endforelse
                </div>
            </div>

            <button id="porto-prev" aria-label="Previous" class="absolute left-2 top-1/2 -translate-y-1/2 bg-primary/80 hover:bg-primary shadow rounded-full p-2 z-20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="porto-next" aria-label="Next" class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary/80 hover:bg-primary shadow rounded-full p-2 z-20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <a href="/produk" class="text-primary font-semibold flex justify-center text-xl mt-5 hover:underline">Lihat Selengkapnya -></a>

            <script>
                (function () {
                    const track = document.getElementById('portfolio-track');
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

                    nextBtn.addEventListener('click', () => { next(); resetAutoplay(); });
                    prevBtn.addEventListener('click', () => { prev(); resetAutoplay(); });

                    function startAutoplay() {
                        if (autoplayInterval) clearInterval(autoplayInterval);
                        autoplayInterval = setInterval(() => { next(); }, 3000);
                    }
                    function resetAutoplay() { startAutoplay(); }

                    viewport.addEventListener('mouseenter', () => { if (autoplayInterval) clearInterval(autoplayInterval); });
                    viewport.addEventListener('mouseleave', () => { startAutoplay(); });

                    window.addEventListener('resize', updateSizes);
                    updateSizes();
                    setTimeout(() => { startAutoplay(); }, 600);
                })();
            </script>
        </div>
    </div>
</section>
