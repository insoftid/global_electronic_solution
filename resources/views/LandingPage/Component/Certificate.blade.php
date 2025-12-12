
<section>
	<div class="max-w-6xl mx-auto px-6 pb-20">
		<h2 class="text-3xl font-extrabold text-heading mb-10 text-center">Sertifikat</h2>

		<div class="relative">
			@php
				// List of certificate images (update/add file names as needed)
				$certificates = [
					'img/sertifikat.png',
					'img/sertifikat.png',
					'img/sertifikat.png',
                    'img/sertifikat.png',
					'img/sertifikat.png',
					'img/sertifikat.png'
				];
			@endphp

			<div id="certificate-viewport" class="overflow-hidden h-auto p-4 justify-center">
				<div id="certificate-track" class="flex items-center gap-5 transition-transform duration-700 ease-in-out">
					@foreach($certificates as $c)
						<div class="shrink-0 w-full md:w-1/3">
							<div class="h-full flex items-center justify-center hover:scale-105 transition-transform duration-300">
								<img src="{{ $c }}" alt="Sertifikat" class="w-full h-full object-contain" />
							</div>
						</div>
					@endforeach
				</div>
			</div>

			<!-- arrows -->
            <button id="cert-prev" aria-label="Previous" class="absolute left-2 top-1/2 -translate-y-1/2 bg-primary/80 hover:bg-primary shadow rounded-full p-2 z-20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button id="cert-next" aria-label="Next" class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary/80 hover:bg-primary shadow rounded-full p-2 z-20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

			<!-- autoplay script -->
            <script>
                (function(){
                    const track = document.getElementById('certificate-track');
                    const getSlides = () => Array.from(track.children);
                    const prevBtn = document.getElementById('cert-prev');
                    const nextBtn = document.getElementById('cert-next');
                    const viewport = document.getElementById('certificate-viewport');
                    let index = 0;
                    let autoplayInterval = null;

                    function visibleCount(){
                        const w = window.innerWidth;
                        if (w >= 768) return 3;
                        if (w >= 640) return 2;
                        return 1;
                    }

                    function updateSizes(){
                        const v = visibleCount();
                        const slides = getSlides();
                        slides.forEach(s => {
                            s.style.flex = `0 0 ${100 / v}%`;
                        });
                        moveTo(index);
                    }

                    function moveTo(i){
                        const v = visibleCount();
                        const slides = getSlides();
                        const maxIndex = Math.max(0, slides.length - v);
                        if (i < 0) i = maxIndex;
                        if (i > maxIndex) i = 0;
                        index = i;

                        // Calculate pixel-based translation so we move exactly one card
                        // per step and account for the gap between flex items.
                        const first = slides[0];
                        if (!first) return;
                        const firstRect = first.getBoundingClientRect();
                        let gap = 0;
                        if (slides.length > 1) {
                            const secondRect = slides[1].getBoundingClientRect();
                            // gap = distance between left edge of second and right edge of first
                            gap = Math.max(0, secondRect.left - firstRect.right);
                        }
                        const step = Math.round(firstRect.width + gap);
                        track.style.transform = `translateX(-${index * step}px)`;
                    }

                    function next(){ moveTo(index + 1); }
                    function prev(){ moveTo(index - 1); }

                    nextBtn.addEventListener('click', () => { next(); resetAutoplay(); });
                    prevBtn.addEventListener('click', () => { prev(); resetAutoplay(); });

                    // autoplay
                    function startAutoplay(){
                        if (autoplayInterval) clearInterval(autoplayInterval);
                        autoplayInterval = setInterval(() => { next(); }, 3000);
                    }
                    function resetAutoplay(){ startAutoplay(); }

                    // pause on hover
                    viewport.addEventListener('mouseenter', () => { if (autoplayInterval) clearInterval(autoplayInterval); });
                    viewport.addEventListener('mouseleave', () => { startAutoplay(); });

                    window.addEventListener('resize', updateSizes);
                    // init
                    updateSizes();
                    // small delay to ensure images load and sizes are correct
                    setTimeout(() => { startAutoplay(); }, 600);
                })();
            </script>
		</div>
	</div>
</section>
