<section>
    <div class="max-w-6xl mx-auto px-6 py-20">
        <div class="w-full">
            <h2 class="text-heading">Ringkasan Proyek</h2>
            <div class="flex gap-5 items-center mt-6">
                <img src={{ asset('img/calendar.png') }} alt="calendar" class="w-8 h-8" />
                <p class="text-graytext font-bold text-2xl">Mon, May 25th 2023</p>
            </div>
            <p class="mt-6 text-graytext font-medium text-xl leading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
            </p>
        </div>
        <div class="mt-8 w-full">
            {{-- Responsive YouTube embed. Provide either $youtubeId (video id) or $youtubeUrl (full YouTube link) from the controller. --}}
            @php
                // prefer explicit video id if provided
                $embedId = null;
                if (!empty($youtubeId ?? '')) {
                    $embedId = $youtubeId;
                }

                // if no id, try to extract from a full youtube URL
                if (empty($embedId) && !empty($youtubeUrl ?? '')) {
                    $matches = [];
                    // match common YouTube URL patterns
                    preg_match('/(?:v=|v\/|embed\/|youtu\.be\/|watch\?v=|&v=)([A-Za-z0-9_-]{11})/', $youtubeUrl, $matches);
                    if (!empty($matches[1])) {
                        $embedId = $matches[1];
                    }
                }

                // fallback to a sample video if none provided (optional)
                $embedId = $embedId ?? 'dQw4w9WgXcQ';
            @endphp
            <div class="aspect-video w-full rounded-lg overflow-hidden bg-black">
                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $embedId }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>