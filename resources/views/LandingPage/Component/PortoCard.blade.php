<a href="{{ $link ?? '#' }}">
    <div
        class="bg-white min-h-[450px] rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300 ease-in-out">
        <div class="relative">
            <img src="{{ $image }}" alt="{{ $title }}"
                class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300 ease-in-out" />
        </div>

        <div class="p-6">
            @if(!empty($category))
                <span class=" bg-primary/20 text-primary text-xs font-medium px-3 py-1 rounded-full">{{ $category }}</span>
            @endif
            <div class="flex items-start justify-between gap-4 mt-4">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $title }}</h3>
                    @if(!empty($company))
                        <div class="text-sm text-primary font-medium">{{ $company }}</div>
                    @endif
                </div>
            </div>

            <p class="text-sm text-gray-600 mt-4 mb-4">{{ $description }}</p>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    @if(!empty($tags) && is_array($tags))
                        @foreach($tags as $tag)
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-md">{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</a>