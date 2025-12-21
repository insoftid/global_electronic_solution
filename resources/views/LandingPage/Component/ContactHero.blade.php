<section class="relative">
    <!-- Background hero using CSS background-image so we can overlay and center content -->
    <div class="relative w-full" style="height: 826px;">
        <!-- Background image layer (dimmed) - put on its own absolute layer so children are not affected -->
        @php
            $heroImage = isset($gallery['hero_contact']) && $gallery['hero_contact']->image_path
                ? asset('storage/' . $gallery['hero_contact']->image_path)
                : asset('img/bghero.png');
        @endphp
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat"
            style="background-image: url('{{ $heroImage }}'); filter: brightness(0.4);"></div>

        <!-- green overlay to match design (gradient) -->
        <div class="absolute inset-0 bg-linear-to-t from-transparent to-primary/80"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-6xl mx-auto h-full flex flex-col items-center justify-center px-6 text-center">
            <h3 class="text-white/60 font-medium text-2xl">Home <span class="text-white">/ Kontak</span></h3>
            <h1
                class="uppercase text-3xl sm:text-4xl md:text-5xl lg:text-[70px] text-white font-extrabold leading-tight tracking-tight max-w-4xl">
                Hubungi
                <span class="text-secondary">Kami</span>
            </h1>
            <p class="mt-4 text-white/90 max-w-xl text-xl">
                Siap membantu mewujudkan proyek sistem elektrikal Anda dengan solusi terbaik dan konsultasi profesional.
            </p>
        </div>
    </div>
</section>