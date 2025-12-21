<section>
    <div class="max-w-6xl mx-auto px-6 py-10">
        @if(isset($portfolios) && $portfolios->count() > 0)
            <div id="projects-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($portfolios as $portfolio)
                    <div class="project-card" data-idx="{{ $loop->index }}">
                        @include('LandingPage.Component.PortoCard', [
                            'image' => $portfolio->thumbnail 
                                ? 'storage/' . $portfolio->thumbnail 
                                : 'img/porto.png',
                            'title' => $portfolio->title,
                            'company' => $portfolio->subtitle,
                            'description' => Str::limit($portfolio->description, 120),
                            'link' => route('portfolio.show', $portfolio->slug),
                            'category' => $portfolio->category->name ?? '',
                            'tags' => $portfolio->tags->pluck('name')->toArray()
                        ])
                    </div>
                @endforeach
            </div>

            {{-- Custom Pagination --}}
            @if($portfolios->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $portfolios->links('vendor.pagination.custom') }}
            </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada proyek</h3>
                <p class="mt-2 text-gray-500">Proyek portfolio akan ditampilkan di sini.</p>
            </div>
        @endif
    </div>
</section>