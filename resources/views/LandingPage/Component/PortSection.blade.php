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

    {{-- AJAX Search Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const projectsGrid = document.getElementById('projects-grid');
            const paginationContainer = document.querySelector('.mt-8.flex.justify-center');
            
            let searchTimeout;
            let currentSearchTerm = '';

            // AJAX Search functionality with debouncing
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    const searchTerm = e.target.value.trim();
                    
                    // Debounce: wait 400ms before making request
                    searchTimeout = setTimeout(() => {
                        if (searchTerm !== currentSearchTerm) {
                            currentSearchTerm = searchTerm;
                            performSearch(searchTerm);
                        }
                    }, 400);
                });

                // Handle Enter key
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        clearTimeout(searchTimeout);
                        currentSearchTerm = e.target.value.trim();
                        performSearch(currentSearchTerm);
                    }
                });
            }

            function performSearch(searchTerm) {
                // Show loading state
                projectsGrid.style.opacity = '0.5';
                projectsGrid.style.pointerEvents = 'none';

                // Build URL with search parameter
                const url = new URL('{{ route("portfolio.search") }}');
                if (searchTerm) {
                    url.searchParams.set('search', searchTerm);
                }

                // Make AJAX request
                fetch(url.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Update grid with new content
                    projectsGrid.innerHTML = data.html;
                    
                    // Hide pagination when searching (optional: you can implement AJAX pagination too)
                    if (paginationContainer) {
                        paginationContainer.style.display = searchTerm ? 'none' : 'flex';
                    }

                    // Add transition styles to new cards
                    const newCards = projectsGrid.querySelectorAll('.project-card');
                    newCards.forEach((card, index) => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(10px)';
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        
                        // Staggered animation
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 50);
                    });
                })
                .catch(error => {
                    console.error('Search error:', error);
                    projectsGrid.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Terjadi kesalahan</h3>
                            <p class="mt-2 text-gray-500">Gagal memuat hasil pencarian. Silakan coba lagi.</p>
                        </div>
                    `;
                })
                .finally(() => {
                    // Remove loading state
                    projectsGrid.style.opacity = '1';
                    projectsGrid.style.pointerEvents = 'auto';
                });
            }

            // Add initial transition styles to cards
            const projectCards = projectsGrid.querySelectorAll('.project-card');
            projectCards.forEach(card => {
                card.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
            });
        });
    </script>
</section>