<section class="relative">
    <!-- Background hero using CSS background-image so we can overlay and center content -->
    @php
        $heroLanding = $gallery['hero_landing'] ?? null;
        $heroImage = $heroLanding && $heroLanding->image_path
            ? asset('storage/' . $heroLanding->image_path)
            : asset('img/bghero.png');
        $heroVideo = $heroLanding && $heroLanding->video_path
            ? asset('storage/' . $heroLanding->video_path)
            : null;
    @endphp
    <div class="relative w-full" style="height: 826px;">
        @if($heroVideo)
            <video
                class="absolute inset-0 w-full h-full object-cover"
                autoplay
                loop
                muted
                playsinline
                poster="{{ $heroImage }}"
            >
                <source src="{{ $heroVideo }}" />
            </video>
        @else
            <div class="absolute inset-0 bg-center bg-cover" style="background-image: url('{{ $heroImage }}');"></div>
        @endif

        <!-- green overlay to match design (gradient) -->
        <div class="absolute inset-0 bg-linear-to-t from-transparent to-primary/80"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-6xl mx-auto h-full flex flex-col items-center justify-center px-6 text-center">
            <h1
                class="uppercase text-3xl sm:text-4xl md:text-5xl lg:text-[70px] text-white font-extrabold leading-tight tracking-tight max-w-4xl">
                {{ $settings['company_name'] ?? 'CV. GLOBAL ELECTRONIC SOLUTION' }}
            </h1>
            <p class="mt-4 text-white/90 max-w-3xl text-xl">
                {{ $settings['tagline'] ?? 'CV. Global Electronic Solution menghadirkan solusi sistem elektrikal modern berbasis riset untuk industri, pemerintahan, dan pengembangan teknologi di Indonesia.' }}
            </p>
            <a href="#tentang"
                class="mt-6 inline-block bg-primary hover:bg-primary/80 text-white px-6 py-3 rounded-xl transition-all duration-200 ease-in-out">Tentang
                Kami</a>
        </div>
    </div>
</section>