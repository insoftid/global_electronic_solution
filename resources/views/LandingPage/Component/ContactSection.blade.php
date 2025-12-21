<section>
    <div class="md:flex my-10 md:my-20 gap-10 max-w-6xl mx-auto px-6">
        <div class="md:w-1/2 mb-10 md:mb-0">
            <h3 class="text-[40px] font-bold text-primary">Kontak Kami</h3>
            <ul class="mt-8 space-y-6">
                <li class="flex gap-5 text-xl items-start">
                    <div class="bg-primary rounded-full p-3">
                        <img src="{{ asset('img/alamat.png') }}" alt="alamat" class="h-4 md:h-5 w-10 object-contain" />
                    </div>
                    <p><span class="font-semibold">Alamat:
                        </span>{{ $settings['address'] ?? 'Perum JL. Beringin Asri, RT 06/RW 12, Wonosari, Kec. Ngalian, Kota Semarang, Jawa Tengah, 50244' }}
                    </p>
                </li>
                <li class="flex gap-5 text-xl items-center">
                    <div class="bg-primary rounded-full p-3">
                        <img src="{{ asset('img/telepon.png') }}" alt="telepon" class="h-5 w-5 object-contain" />
                    </div>
                    <p><span class="font-semibold">Phone:
                        </span>{{ $settings['whatsapp'] ?? $settings['phone'] ?? '+62 12345670' }}</p>
                </li>
                <li class="flex gap-5 text-xl items-center">
                    <div class="bg-primary rounded-full p-3">
                        <img src="{{ asset('img/email.png') }}" alt="email" class="h-5 w-5 object-contain" />
                    </div>
                    <p><span class="font-semibold">Email: </span>{{ $settings['email'] ?? 'info@gmail.com' }}</p>
                </li>
                <li class="flex gap-5 text-xl items-start">
                    <div class="bg-primary rounded-full p-3 hidden md:block">
                        <img src="{{ asset('img/maps.png') }}" alt="maps" class="h-6 w-6 object-contain" />
                    </div>
                    <div class="embed-map-responsive">
                        <div class="embed-map-container rounded-2xl"><iframe class="embed-map-frame" frameborder="0"
                                scrolling="no" marginheight="0" marginwidth="0"
                                src="{{ $settings['google_maps_url'] ?? 'https://maps.google.com/maps?width=535&height=400&hl=en&q=CV%20GLOBAL%20ELECTRONIC%20SOLUTION%2C%20Semarang&t=&z=14&ie=UTF8&iwloc=B&output=embed' }}"></iframe>
                        </div>
                    </div>
                    <style>
                        .embed-map-responsive {
                            position: relative;
                            text-align: right;
                            width: 100%;
                            height: 0;
                            padding-bottom: 74.76635514018692%;
                        }

                        .embed-map-container {
                            overflow: hidden;
                            background: none !important;
                            width: 100%;
                            height: 100%;
                            position: absolute;
                            top: 0;
                            left: 0;
                        }

                        .embed-map-frame {
                            width: 100% !important;
                            height: 100% !important;
                            position: absolute;
                            top: 0;
                            left: 0;
                        }
                    </style>
                </li>
            </ul>
        </div>
        <div class="md:w-1/2 flex flex-col justify-center bg-primary p-10 rounded-2xl">
            <h2 class="text-3xl font-bold text-center text-white mb-6">Beri Tanggapan Anda</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-white mb-1">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white" />
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-white mb-1">Subjek (opsional)</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white" />
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-white mb-1">Pesan</label>
                    <textarea id="message" name="message" rows="5" required
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">{{ old('message') }}</textarea>
                </div>
                <div class="flex justify-center">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                        data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                </div>
                <div>
                    <button type="submit" id="contactSubmitBtn" disabled
                        class="bg-secondary flex mx-auto text-white font-semibold px-10 py-3 rounded-md transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-secondary/80 disabled:hover:bg-secondary">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // reCAPTCHA callbacks
        function onRecaptchaSuccess(token) {
            document.getElementById('contactSubmitBtn').disabled = false;
        }

        function onRecaptchaExpired() {
            document.getElementById('contactSubmitBtn').disabled = true;
        }
    </script>
</section>