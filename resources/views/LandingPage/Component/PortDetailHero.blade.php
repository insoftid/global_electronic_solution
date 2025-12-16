<section class="relative">
    <!-- Background hero using CSS background-image so we can overlay and center content -->
    <div class="relative w-full" style="height: 826px;">
        <!-- Background image layer (dimmed) - put on its own absolute layer so children are not affected -->
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat" style="background-image: url('{{ asset('img/bghero.png') }}'); filter: brightness(0.4);"></div>

    <!-- green overlay to match design (gradient) -->
    <div class="absolute inset-0 bg-linear-to-t from-transparent to-primary/80"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-6xl mx-auto h-full flex flex-col items-center justify-center px-6 text-center">
            <h3 class="text-white/60 font-medium text-2xl">Home / Portfolio <span class="text-white">/ Automated Production Line</span></h3>
            <h1 class="uppercase text-3xl sm:text-4xl md:text-5xl lg:text-[70px] text-white font-extrabold leading-tight tracking-tight max-w-4xl">
                Automated 
                <br><span class="text-secondary">Production Line</span>
            </h1>
            <p class="mt-4 text-white/90 max-w-3xl text-xl">
                Sistem otomasi lini produksi makanan dengan kontrol kualitas terintegrasi dan efisiensi maksimal untuk Indofood Manufacturing.
            </p>
            {{-- <div class="grid grid-cols-2 md:grid-cols-4 mt-6 gap-10">
                <div>
                    <h6 class="uppercase text-white/60 font-medium mb-3">Klien</h6>
                    <p class="text-white text-lg font-medium">Indofood Manufacturing</p>
                </div>
                <div>
                    <h6 class="uppercase text-white/60 font-medium mb-3">Kategori</h6>
                    <p class="text-white text-lg font-medium">Automation</p>
                </div>
                <div>
                    <h6 class="uppercase text-white/60 font-medium mb-3">Durasi</h6>
                    <p class="text-white text-lg font-medium">8 Bulan</p>
                </div>
                <div>
                    <h6 class="uppercase text-white/60 font-medium mb-3">Status</h6>
                    <p class="text-white text-lg font-medium">Completed</p>
                </div>
            </div> --}}
        </div>
    </div>
</section>