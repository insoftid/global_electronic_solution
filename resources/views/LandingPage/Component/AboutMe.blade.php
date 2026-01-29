{{-- resources/views/LandingPage/Component/AboutMe.blade.php --}}
<div id="tentang" class="max-w-6xl mx-auto py-10 md:py-20">
    <!-- Header: image + about text -->
    <div class="flex flex-col md:flex-row items-center mb-10 gap-10 md:mb-20">
        <div class="text-center order-2 md:order-1">
            <div class="w-[365px] h-[365px] mb-4 rounded-xl overflow-hidden">
                <img src="{{ isset($gallery['about_1']) && $gallery['about_1']->image_path ? asset('storage/' . $gallery['about_1']->image_path) : asset('img/bghero.png') }}"
                    alt="about" class="w-full h-full object-cover" />
            </div>
        </div>

        <div class="mx-4 md:ml-20 order-1 md:order-2">
            <h3 class="text-heading text-center md:text-left">Tentang Kami</h3>
            <p class="text-paragraph mt-3 leading-tight text-center md:text-left">
                {{ $settings['about_description'] ?? 'CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal. Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan sistem elektronika serta solusi otomasi yang efisien dan andal.' }}
            </p>
        </div>
    </div>

    <!-- Middle: Visi | img | Misi -->
    <div class="flex flex-col md:flex-row items-start mb-4 px-4 md:px-0 gap-10">
        {{-- VISI --}}
        <div class="w-full md:w-1/3">
            <div class="text-center mb-10">
                <h4 class="text-heading">Visi</h4>
            </div>
            <div class="text-paragraph leading-tight">
                {!! nl2br(
                    e(
                        $settings['about_vision'] ??
                            'Menjadi perusahaan terdepan dalam solusi sistem elektrikal dan otomasi industri di Indonesia.',
                    ),
                ) !!}
            </div>
        </div>

        {{-- GAMBAR --}}
        <div class="w-1/3 hidden md:block">
            <div class="w-full overflow-hidden rounded-t-xl">
                <img src="{{ isset($gallery['about_2']) && $gallery['about_2']->image_path ? asset('storage/' . $gallery['about_2']->image_path) : asset('img/bghero.png') }}"
                    alt="work-1" class="w-full h-72 object-cover" />
            </div>
            <div class="w-full overflow-hidden rounded-b-xl">
                <img src="{{ isset($gallery['about_3']) && $gallery['about_3']->image_path ? asset('storage/' . $gallery['about_3']->image_path) : asset('img/bghero.png') }}"
                    alt="work-2" class="w-full h-72 object-cover" />
            </div>
        </div>

        {{-- MISI --}}
        <div class="w-full md:w-1/3">
            <div class="text-center mb-10">
                <h4 class="text-heading">Misi</h4>
            </div>

            @php
                $misiRaw = $settings['about_mission'] ?? '';
                $misiItems = preg_split("/\r\n|\n|\r/", $misiRaw);

                $misiItems = array_values(
                    array_filter(
                        array_map(function ($line) {
                            $line = trim($line);
                            // hapus nomor kalau admin nulis "1. ..." / "1) ..." / "1-" / dst
                            $line = preg_replace('/^\s*\d+\s*[\.\)\-:]\s*/', '', $line);
                            return $line;
                        }, $misiItems),
                    ),
                );
            @endphp

            @if (count($misiItems))
                <div class="space-y-3 text-paragraph leading-tight">
                    @foreach ($misiItems as $i => $item)
                        <div class="flex gap-3 items-start">
                            <span class="font-semibold min-w-[24px] text-right">{{ $i + 1 }}.</span>
                            <p class="flex-1">{{ $item }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-paragraph leading-tight">—</p>
            @endif
        </div>
    </div>

    <!-- Footer: Quality Policy -->
    <div class="mt-10 md:mt-20">
        <div class="text-center">
            <div class="text-center mb-5">
                <h4 class="text-heading">Kebijakan Mutu</h4>
            </div>
            <p class="text-paragraph leading-tight max-w-3xl mx-auto">
                {{ $settings['quality_policy'] ?? 'Kami berkomitmen untuk menyediakan produk dan layanan berkualitas tinggi yang memenuhi standar internasional, dengan fokus pada kepuasan pelanggan dan perbaikan berkelanjutan.' }}
            </p>
        </div>
    </div>
</div>
