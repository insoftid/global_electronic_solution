@php
    // Clean WhatsApp number (remove +, spaces, dashes)
    $whatsappNumber = preg_replace('/[\s\-\+]/', '', $settings['whatsapp'] ?? '');

    // Create WhatsApp message
    $message = urlencode("Halo, saya tertarik dengan proyek {$portfolio->title}. Boleh saya konsultasi?");

    // Build WhatsApp URL
    $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$message}";
@endphp

<section class="max-w-6xl mx-auto px-6 mb-20">
    <div class="bg-secondary mx-auto px-6 py-16 flex flex-col gap-5 items-center justify-center rounded-xl ">
        <h3 class="text-white font-bold text-3xl text-center">
            Tertarik dengan Proyek Serupa?
        </h3>
        <p class="text-white text-lg ml-4 text-center">Mari diskusikan kebutuhan otomasi industri Anda dan temukan
            solusi terbaik bersama tim ahli kami.</p>
        <div class="mt-3 flex flex-col md:flex-row gap-4">
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                class="text-secondary font-semibold bg-white px-6 py-4 rounded-lg text-center hover:bg-gray-100 transition-colors">Konsultasi
                Gratis</a>
            <a href="/produk"
                class="text-white font-semibold bg-transparent border-2 border-white px-6 py-4 rounded-lg text-center hover:bg-white/10 transition-colors">Lihat
                Portfolio Lain</a>
        </div>
    </div>
</section>