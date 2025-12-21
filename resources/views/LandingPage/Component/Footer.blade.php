{{-- Footer component for Landing Page --}}
<footer class="bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-2">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-0">
            <!-- Left: logo + description -->
            <div class="lg:w-1/2 items-start gap-4">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-md shrink-0">
                        @if(isset($settings['logo']) && $settings['logo'])
                            <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo"
                                class="w-8 h-8 object-contain" />
                        @else
                            <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
                            </svg>
                        @endif
                    </span>
                    <h3 class="font-semibold text-white text-2xl">
                        {{ $settings['company_name'] ?? 'Global Electronic Solution' }}</h3>
                </div>
                <div>
                    <p class="mt-3 text-lg text-white max-w-md">
                        {{ $settings['tagline'] ?? 'Layanan servis elektronik profesional dengan teknologi modern dan transparansi penuh untuk kepuasan pelanggan yang terbaik.' }}
                    </p>
                </div>
                <div class="mt-7 flex items-center gap-4">
                    @if(isset($settings['instagram_url']) && $settings['instagram_url'])
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-block bg-white rounded-full p-3 hover:bg-white/70 transition-colors duration-300">
                            <img src="{{ asset('img/ig.png') }}" alt="Instagram" class="w-7 h-7 object-contain" />
                        </a>
                    @endif
                    @if(isset($settings['facebook_url']) && $settings['facebook_url'])
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-block bg-white rounded-full p-3 hover:bg-white/70 transition-colors duration-300">
                            <img src="{{ asset('img/fb.png') }}" alt="Facebook" class="w-7 h-7 object-contain" />
                        </a>
                    @endif
                    @if(isset($settings['youtube_url']) && $settings['youtube_url'])
                        <a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-block bg-white rounded-full p-3 hover:bg-white/70 transition-colors duration-300">
                            <img src="{{ asset('img/yt.png') }}" alt="YouTube" class="w-7 h-7 object-contain" />
                        </a>
                    @endif
                    @if(isset($settings['tiktok_url']) && $settings['tiktok_url'])
                        <a href="{{ $settings['tiktok_url'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-block bg-white rounded-full p-3 hover:bg-white/70 transition-colors duration-300">
                            <img src="{{ asset('img/tiktok.png') }}" alt="TikTok" class="w-7 h-7 object-contain" />
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right: columns -->
            <div class="lg:w-1/2 flex flex-col sm:flex-row justify-end gap-14">
                <div class="min-w-35">
                    <h4 class="font-semibold mb-5 text-xl">Perusahaan</h4>
                    <ul class="space-y-2 text-md text-white">
                        <li><a href="#tentang" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="{{ route('portfolio.index') }}" class="hover:underline">Portfolio</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:underline">Kontak</a></li>
                    </ul>
                </div>

                <div class="min-w-50">
                    <h4 class="font-semibold mb-5 text-xl">Kontak</h4>
                    <div class="text-md text-white space-y-2 max-w-2xs">
                        <div>{{ $settings['whatsapp'] ?? $settings['phone'] ?? '0812-3456-7890' }}</div>
                        <div>{{ $settings['email'] ?? 'info@gmail.com' }}</div>
                        <div>
                            {{ $settings['address'] ?? 'Perum JL. Beringin Asri, RT 06/RW 12, Wonosari, Kec. Ngalian, Kota Semarang, Jawa Tengah, 50244' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="border-t-2 border-secondary/70 mt-8 py-6">
        <p class="text-center text-sm text-white">Designed By Insoft.id © {{ date('Y') }}
            {{ $settings['company_name'] ?? 'CV. Global Electronic Solution' }}. All rights reserved.</p>
    </div>
</footer>