<section>
    <div class="max-w-6xl mx-auto px-6 py-10">
        @if(isset($portfolios) && $portfolios->count() > 0)
            {{-- Search and Filter Section --}}
            <div class="mb-8 space-y-4">
                {{-- Search Bar --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="search-input"
                        placeholder="Cari portfolio berdasarkan judul, kategori, atau tags..." 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"
                    >
                </div>
            </div>
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

    {{-- Search and Filter Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const filterBtns = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');
            
            let currentFilter = 'all';
            let searchTimeout;

            // Search functionality with debouncing
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        filterProjects();
                    }, 300); // 300ms debounce
                });
            }

            // Filter button functionality
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active state
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'hover:shadow-lg');
                        b.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    });
                    this.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    this.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'hover:shadow-lg');
                    
                    currentFilter = this.dataset.filter;
                    filterProjects();
                });
            });

            function filterProjects() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
                let visibleCount = 0;

                projectCards.forEach(card => {
                    const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                    const description = card.querySelector('p')?.textContent.toLowerCase() || '';
                    const category = card.querySelector('[data-category]')?.dataset.category?.toLowerCase() || '';
                    const tags = card.querySelector('[data-tags]')?.dataset.tags?.toLowerCase() || '';
                    
                    // Check search match
                    const matchesSearch = !searchTerm || 
                        title.includes(searchTerm) || 
                        description.includes(searchTerm) || 
                        category.includes(searchTerm) || 
                        tags.includes(searchTerm);
                    
                    // Check filter match
                    const matchesFilter = currentFilter === 'all' || 
                        category === currentFilter.toLowerCase();
                    
                    // Show/hide card with animation
                    if (matchesSearch && matchesFilter) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 10);
                        visibleCount++;
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 200);
                    }
                });

                // Show "no results" message if needed
                showNoResultsMessage(visibleCount === 0);
            }

            function showNoResultsMessage(show) {
                let noResultsDiv = document.getElementById('no-results-message');
                
                if (show) {
                    if (!noResultsDiv) {
                        noResultsDiv = document.createElement('div');
                        noResultsDiv.id = 'no-results-message';
                        noResultsDiv.className = 'col-span-full text-center py-12';
                        noResultsDiv.innerHTML = `
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
                            <p class="mt-2 text-gray-500">Coba ubah kata kunci pencarian atau filter Anda.</p>
                        `;
                        document.getElementById('projects-grid').appendChild(noResultsDiv);
                    }
                    noResultsDiv.style.display = 'block';
                } else {
                    if (noResultsDiv) {
                        noResultsDiv.style.display = 'none';
                    }
                }
            }

            // Add transition styles to cards
            projectCards.forEach(card => {
                card.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
            });
        });
    </script>
</section>