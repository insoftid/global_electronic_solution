@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <ul class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed text-sm font-medium">
                        Prev
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-4 py-2 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-medium transition-colors">
                        Prev
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-2 text-gray-500 text-sm">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium shadow-md">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-4 py-2 rounded-lg bg-primary/80 hover:bg-primary text-white text-sm font-medium transition-colors">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-4 py-2 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-medium transition-colors">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed text-sm font-medium">
                        Next
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif