@php
    $title = $portfolio->title ?? 'Proyek';
@endphp
<section class="relative">
    <!-- Background hero using CSS background-image so we can overlay and center content -->
    <div class="relative w-full" style="height: 826px;">
        <!-- Background image layer (dimmed) - use portfolio thumbnail or fallback -->
        @php
            $heroImage = $portfolio->thumbnail
                ? asset('storage/' . $portfolio->thumbnail)
                : asset('img/bghero.png');
        @endphp
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat"
            style="background-image: url('{{ $heroImage }}'); filter: brightness(0.4);"></div>

        <!-- green overlay to match design (gradient) -->
        <div class="absolute inset-0 bg-linear-to-t from-transparent to-primary/80"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-6xl mx-auto h-full flex flex-col items-center justify-center px-6 text-center">
            {{-- Breadcrumb --}}
            <h3 class="text-white/60 font-medium text-2xl">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a> /
                <a href="{{ route('portfolio.index') }}" class="hover:text-white transition">Portfolio</a>
                <span class="text-white">/ {{ $portfolio->title }}</span>
            </h3>

            {{-- Title - Split first word and rest for styling --}}
            @php
                $words = explode(' ', $portfolio->title ?? 'Proyek', 2);
                $firstWord = $words[0] ?? '';
                $restWords = $words[1] ?? '';
            @endphp
            <h1
                class="uppercase text-3xl sm:text-4xl md:text-5xl lg:text-[70px] text-white font-extrabold leading-tight tracking-tight max-w-4xl mt-4">
                {{ $firstWord }}
                @if($restWords)
                    <br><span class="text-secondary">{{ $restWords }}</span>
                @endif
            </h1>

            {{-- Subtitle/Short Description --}}
            @if($portfolio->subtitle)
                <p class="mt-4 text-white/90 max-w-3xl text-xl">
                    {{ $portfolio->subtitle }}
                </p>
            @endif

            {{-- Meta Info --}}
            <!-- <div class="grid grid-cols-2 md:grid-cols-3 mt-8 gap-8">
                @if($portfolio->category)
                    <div>
                        <h6 class="uppercase text-white/60 font-medium mb-2 text-sm">Kategori</h6>
                        <p class="text-white text-lg font-medium">{{ $portfolio->category->name }}</p>
                    </div>
                @endif
                @if($portfolio->project_date)
                    <div>
                        <h6 class="uppercase text-white/60 font-medium mb-2 text-sm">Tanggal</h6>
                        <p class="text-white text-lg font-medium">{{ $portfolio->project_date->format('d M Y') }}</p>
                    </div>
                @endif
                <div>
                    <h6 class="uppercase text-white/60 font-medium mb-2 text-sm">Status</h6>
                    <p class="text-white text-lg font-medium">{{ $portfolio->is_active ? 'Selesai' : 'Draft' }}</p>
                </div>
            </div> -->
        </div>
    </div>
</section>