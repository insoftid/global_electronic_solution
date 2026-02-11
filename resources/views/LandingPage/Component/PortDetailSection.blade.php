<section>
    <div class="max-w-6xl mx-auto px-6 py-20">
        <div class="flex flex-col lg:flex-row gap-12">
            {{-- Left Column: Description --}}
            <div class="w-full">
                <h2 class="text-heading">Ringkasan Produk</h2>

                <!-- {{-- Project Date --}}
                @if($portfolio->project_date)
                    <div class="flex gap-5 items-center mt-6">
                        <img src="{{ asset('img/calendar.png') }}" alt="calendar" class="w-8 h-8" />
                        <p class="text-graytext font-bold text-2xl">{{ $portfolio->project_date->format('l, F jS Y') }}</p>
                    </div>
                @endif -->

                {{-- Description (rendered as HTML from WYSIWYG editor) --}}
                <div
                    class="mt-6 text-graytext font-medium text-xl leading-relaxed prose prose-lg max-w-none prose-p:my-2 prose-ul:my-2 prose-ol:my-2 prose-li:my-0">
                    {!! $portfolio->description !!}
                </div>

                {{-- Detail (rendered as HTML from WYSIWYG editor) --}}
                @if($portfolio->detail)
                    <div class="mt-8">
                        <!-- s -->
                        <div
                            class="text-graytext font-medium text-lg leading-relaxed prose prose-lg max-w-none prose-p:my-2 prose-ul:my-2 prose-ol:my-2 prose-li:my-0">
                            {!! $portfolio->detail !!}
                        </div>
                    </div>
                @endif

                {{-- Tags --}}
                @if($portfolio->tags && $portfolio->tags->count() > 0)
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($portfolio->tags as $tag)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary/10 text-primary">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Right Column: Metrics --}}
            {{-- @if($portfolio->efficiency_increase || $portfolio->waste_reduction || $portfolio->roi_months ||
            $portfolio->downtime_reduction || $portfolio->quality_rate)
            <div class="w-full lg:w-1/3">
                <div class="space-y-6">
                    @if($portfolio->efficiency_increase)
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Peningkatan Efisiensi</p>
                        <p class="text-3xl font-bold text-primary">{{ $portfolio->efficiency_increase }}</p>
                    </div>
                    @endif

                    @if($portfolio->waste_reduction)
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pengurangan Waste</p>
                        <p class="text-3xl font-bold text-primary">{{ $portfolio->waste_reduction }}</p>
                    </div>
                    @endif

                    @if($portfolio->roi_months)
                    <div>
                        <p class="text-sm text-gray-500 font-medium">ROI dalam</p>
                        <p class="text-3xl font-bold text-primary">{{ $portfolio->roi_months }}</p>
                    </div>
                    @endif

                    @if($portfolio->downtime_reduction)
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Downtime Berkurang</p>
                        <p class="text-3xl font-bold text-primary">{{ $portfolio->downtime_reduction }}</p>
                    </div>
                    @endif

                    @if($portfolio->quality_rate)
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Quality Rate</p>
                        <p class="text-3xl font-bold text-primary">{{ $portfolio->quality_rate }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif --}}
        </div>

        {{-- YouTube Video (if available) --}}
        @if($portfolio->youtube_url)
            <div class="mt-12 w-full">
                @php
                    // Extract YouTube video ID from URL
                    $embedId = null;
                    $youtubeUrl = $portfolio->youtube_url;

                    if (!empty($youtubeUrl)) {
                        $matches = [];
                        preg_match('/(?:v=|v\/|embed\/|youtu\.be\/|watch\?v=|&v=)([A-Za-z0-9_-]{11})/', $youtubeUrl, $matches);
                        if (!empty($matches[1])) {
                            $embedId = $matches[1];
                        }
                    }
                @endphp

                @if($embedId)
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Video Produk</h3>
                    <div class="aspect-video w-full rounded-lg overflow-hidden bg-black shadow-lg">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $embedId }}"
                            title="{{ $portfolio->title }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>