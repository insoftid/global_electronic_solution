<section>
    <div class="max-w-6xl mx-auto px-6 pb-20">
        <h2 class="text-3xl font-extrabold text-heading mb-10 text-center">Kerjasama</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center justify-items-center">
            @forelse($partners as $partner)
                @if($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer"
                        class="w-full max-w-sm h-auto">
                        <img src="{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : asset('img/partner-placeholder.png') }}"
                            alt="{{ $partner->name }}"
                            class="w-full h-auto object-contain hover:scale-105 transition-transform duration-300 ease-in-out" />
                    </a>
                @else
                    <img src="{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : asset('img/partner-placeholder.png') }}"
                        alt="{{ $partner->name }}"
                        class="w-full max-w-sm h-auto object-contain hover:scale-105 transition-transform duration-300 ease-in-out" />
                @endif
            @empty
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Belum ada partner yang ditampilkan.
                </div>
            @endforelse
        </div>
    </div>
</section>