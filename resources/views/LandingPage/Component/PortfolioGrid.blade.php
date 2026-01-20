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

@if($portfolios->isEmpty())
    <div id="no-results-message" class="col-span-full text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
        <p class="mt-2 text-gray-500">Coba ubah kata kunci pencarian atau filter Anda.</p>
    </div>
@endif
