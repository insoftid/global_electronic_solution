<section>
    <div
        class="flex flex-col lg:flex-row my-8 md:my-16 lg:my-20 gap-6 md:gap-8 lg:gap-10 max-w-6xl mx-auto px-4 md:px-6">
        <div class="w-full lg:w-1/2 mb-8 md:mb-0">
            <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-primary">Kontak Kami</h3>
            <ul class="mt-6 md:mt-8 space-y-4 md:space-y-6">
                <li class="flex gap-3 md:gap-5 text-base md:text-lg lg:text-xl items-start">
                    <div class="bg-primary rounded-full p-2 md:p-3 shrink-0">
                        <svg class="w-4 h-5 md:w-[19px] md:h-6" viewBox="0 0 19 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.5 11.4C8.60016 11.4 7.73717 11.0839 7.10089 10.5213C6.4646 9.95871 6.10714 9.19565 6.10714 8.4C6.10714 7.60435 6.4646 6.84129 7.10089 6.27868C7.73717 5.71607 8.60016 5.4 9.5 5.4C10.3998 5.4 11.2628 5.71607 11.8991 6.27868C12.5354 6.84129 12.8929 7.60435 12.8929 8.4C12.8929 8.79397 12.8051 9.18407 12.6346 9.54805C12.4641 9.91203 12.2142 10.2427 11.8991 10.5213C11.5841 10.7999 11.21 11.0209 10.7984 11.1716C10.3868 11.3224 9.94556 11.4 9.5 11.4ZM9.5 0C6.98044 0 4.56408 0.884997 2.78249 2.4603C1.00089 4.03561 0 6.17218 0 8.4C0 14.7 9.5 24 9.5 24C9.5 24 19 14.7 19 8.4C19 6.17218 17.9991 4.03561 16.2175 2.4603C14.4359 0.884997 12.0196 0 9.5 0Z"
                                fill="white" />
                        </svg>
                    </div>
                    <p><span class="font-semibold">Alamat:
                        </span>{{ $settings['address'] ?? 'Perum JL. Beringin Asri, RT 06/RW 12, Wonosari, Kec. Ngalian, Kota Semarang, Jawa Tengah, 50244' }}
                    </p>
                </li>
                <li class="flex gap-3 md:gap-5 text-base md:text-lg lg:text-xl items-center">
                    <div class="bg-primary rounded-full p-2 md:p-3 shrink-0">
                        <svg class="w-5 h-5 md:w-[23px] md:h-[22px]" viewBox="0 0 23 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.9195 21.9969C15.2607 21.9385 10.5596 21.3172 5.63618 16.6099C0.713911 11.9015 0.0653638 7.40679 0.00315864 5.81933C-0.0889971 3.40014 1.84858 1.05035 4.08681 0.132686C4.35634 0.0213839 4.6515 -0.0209921 4.94332 0.00971599C5.23514 0.0404241 5.5136 0.143161 5.75138 0.307846C7.59449 1.59235 8.86624 3.53564 9.95829 5.06361C10.1986 5.39931 10.3013 5.80782 10.2469 6.21129C10.1925 6.61477 9.98483 6.98501 9.66339 7.25146L7.41594 8.84773C7.30736 8.92272 7.23093 9.03284 7.20084 9.15765C7.17076 9.28246 7.18906 9.41347 7.25236 9.52634C7.76152 10.411 8.66695 11.7285 9.70371 12.72C10.7405 13.7115 12.1838 14.6346 13.1734 15.1766C13.2974 15.2432 13.4435 15.2619 13.5815 15.2287C13.7194 15.1955 13.8389 15.113 13.9152 14.9982L15.3782 12.8687C15.6472 12.527 16.0439 12.2981 16.4854 12.23C16.9269 12.1618 17.3789 12.2596 17.7466 12.503C19.3674 13.576 21.2589 14.7712 22.6435 16.4667C22.8297 16.6957 22.9482 16.9683 22.9865 17.2561C23.0247 17.5439 22.9815 17.8363 22.8612 18.1026C21.8971 20.2541 19.4572 22.0861 16.9195 21.9969Z"
                                fill="white" />
                        </svg>
                    </div>
                    <p><span class="font-semibold">Phone:
                        </span>{{ $settings['whatsapp'] ?? $settings['phone'] ?? '+62 12345670' }}</p>
                </li>
                <li class="flex gap-3 md:gap-5 text-base md:text-lg lg:text-xl items-center">
                    <div class="bg-primary rounded-full p-2 md:p-3 shrink-0">
                        <svg class="w-5 h-4 md:w-[21px] md:h-[18px]" viewBox="0 0 21 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.736 0.125874C18.1709 -0.00988247 18.642 -0.0364708 19.094 0.0492341C19.546 0.134939 19.96 0.329375 20.2874 0.609691C20.6148 0.890008 20.842 1.24455 20.9423 1.63166C21.0425 2.01877 21.0117 2.42235 20.8535 2.79498L15.489 16.5673C15.3585 16.9058 15.1288 17.2099 14.8219 17.4505C14.5149 17.6911 14.141 17.8603 13.7359 17.9418C13.3318 18.0259 12.9091 18.0188 12.5091 17.9209C12.1092 17.8231 11.7458 17.638 11.4545 17.3838L8.57565 14.9294L5.55273 16.2691C5.43686 16.3205 5.30731 16.3452 5.17689 16.3407C5.04646 16.3362 4.91967 16.3026 4.80904 16.2433C4.6984 16.1839 4.60774 16.1009 4.54601 16.0024C4.48428 15.9039 4.45361 15.7933 4.45704 15.6815L4.58162 11.5878L15.1558 5.00894C15.2556 4.9469 15.3401 4.86863 15.4045 4.77861C15.4689 4.68859 15.512 4.58858 15.5313 4.4843C15.5506 4.38001 15.5457 4.27349 15.517 4.17081C15.4882 4.06814 15.4362 3.97132 15.3637 3.88589C15.2913 3.80046 15.1999 3.72808 15.0948 3.6729C14.9897 3.61771 14.873 3.5808 14.7512 3.56426C14.6295 3.54773 14.5051 3.55189 14.3853 3.57653C14.2654 3.60116 14.1524 3.64577 14.0526 3.70782L3.2998 10.3986L0.703155 8.17432C0.423307 7.93454 0.216988 7.63923 0.102553 7.31466C-0.0118812 6.99008 -0.0308829 6.64631 0.0472386 6.31392C0.125654 5.95068 0.315437 5.61184 0.597129 5.33214C0.87882 5.05244 1.24228 4.84194 1.65026 4.72223H1.65626L17.736 0.125874Z"
                                fill="white" />
                        </svg>
                    </div>
                    <p><span class="font-semibold">Email: </span>{{ $settings['email'] ?? 'info@gmail.com' }}</p>
                </li>
                <li class="flex gap-3 md:gap-5 text-base md:text-lg lg:text-xl items-start">
                    <div class="bg-primary rounded-full p-2 md:p-3 hidden md:block shrink-0">
                        <svg class="w-5 h-4 md:w-[22px] md:h-[18px]" viewBox="0 0 22 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 5.0159C21.9988 4.82086 21.9431 4.629 21.8377 4.45683C21.7323 4.28466 21.5804 4.13734 21.395 4.02755L14.9785 0.233554C14.753 0.0995628 14.4862 0.0278778 14.2131 0.0278778C13.94 0.0278778 13.6732 0.0995628 13.4477 0.233554L8.08535 3.66887C8.00544 3.71941 7.90917 3.74664 7.81035 3.74664C7.71154 3.74664 7.61527 3.71941 7.53536 3.66887L2.19134 0.233554C1.98391 0.100462 1.73763 0.0207572 1.4806 0.00353468C1.22358 -0.0136879 0.966163 0.032266 0.737733 0.136152C0.509302 0.240038 0.319058 0.397671 0.188713 0.591062C0.0583685 0.784453 -0.00682755 1.00581 0.000565747 1.22988V12.9865C0.00176199 13.1815 0.0574514 13.3734 0.16284 13.5456C0.268228 13.7177 0.420158 13.865 0.605549 13.9748L7.02204 17.7688C7.24755 17.9028 7.51431 17.9745 7.78744 17.9745C8.06056 17.9745 8.32733 17.9028 8.55283 17.7688L13.8969 14.3494C13.9768 14.2989 14.073 14.2717 14.1718 14.2717C14.2707 14.2717 14.3669 14.2989 14.4468 14.3494L19.8092 17.7688C20.0472 17.9171 20.3322 17.9979 20.625 18C20.8059 18.001 20.9853 17.9708 21.1526 17.9111C21.32 17.8514 21.472 17.7634 21.6 17.6522C21.7279 17.5409 21.8291 17.4087 21.8978 17.2632C21.9665 17.1176 22.0012 16.9617 22 16.8044V5.0159ZM8.70866 5.43834C8.70717 5.37625 8.72308 5.31478 8.75502 5.25923C8.78696 5.20368 8.83397 5.15573 8.89199 5.11952L12.9252 2.4972C12.9611 2.47819 13.0023 2.46814 13.0444 2.46814C13.0864 2.46814 13.1276 2.47819 13.1635 2.4972C13.1944 2.50895 13.2219 2.52647 13.2441 2.54851C13.2663 2.57055 13.2826 2.59658 13.2919 2.62473V12.564C13.2934 12.6261 13.2775 12.6876 13.2455 12.7431C13.2136 12.7987 13.1666 12.8466 13.1085 12.8829L9.07532 15.5052C9.03942 15.5242 8.99819 15.5342 8.95616 15.5342C8.91412 15.5342 8.8729 15.5242 8.83699 15.5052C8.80614 15.4934 8.77864 15.4759 8.75646 15.4539C8.73428 15.4318 8.71796 15.4058 8.70866 15.3777V5.43834ZM1.83385 2.40952C1.83289 2.3715 1.84447 2.33404 1.86721 2.30155C1.88995 2.26907 1.9229 2.24292 1.96218 2.2262C1.99808 2.20719 2.03931 2.19714 2.08134 2.19714C2.12338 2.19714 2.1646 2.20719 2.20051 2.2262L6.69205 5.10358C6.74846 5.14112 6.79428 5.18934 6.82605 5.24458C6.85781 5.29983 6.87468 5.36064 6.87538 5.4224V15.3777C6.87549 15.4135 6.86448 15.4487 6.84351 15.4796C6.82254 15.5104 6.79238 15.5358 6.75622 15.553C6.7197 15.5704 6.67871 15.5796 6.63705 15.5796C6.59539 15.5796 6.5544 15.5704 6.51789 15.553L2.03551 12.8829C1.97338 12.8472 1.92243 12.7986 1.88723 12.7416C1.85202 12.6846 1.83368 12.6208 1.83385 12.5561V2.40952ZM20.1667 15.5929C20.1676 15.6309 20.1561 15.6683 20.1333 15.7008C20.1106 15.7333 20.0776 15.7595 20.0384 15.7762C20.0025 15.7952 19.9612 15.8052 19.9192 15.8052C19.8772 15.8052 19.8359 15.7952 19.8 15.7762L15.3085 12.9227C15.2521 12.8852 15.2063 12.837 15.1745 12.7817C15.1427 12.7265 15.1259 12.6657 15.1252 12.6039V2.62473C15.125 2.58888 15.1361 2.55367 15.157 2.52281C15.178 2.49195 15.2082 2.46658 15.2443 2.44937C15.2808 2.43193 15.3218 2.42279 15.3635 2.42279C15.4051 2.42279 15.4461 2.43193 15.4826 2.44937L19.965 5.10358C20.0272 5.13925 20.0781 5.18779 20.1133 5.24483C20.1485 5.30188 20.1669 5.36563 20.1667 5.43037V15.5929Z"
                                fill="white" />
                        </svg>
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
        <div class="w-full lg:w-1/2 flex flex-col justify-center bg-primary p-6 md:p-8 lg:p-10 rounded-2xl">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-white mb-4 md:mb-6">Beri Tanggapan Anda</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
            </div> @endif @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4 md:space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm md:text-base font-medium text-white mb-1">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-2 md:p-3 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white" />
                </div>
                <div>
                    <label for="email" class="block text-sm md:text-base font-medium text-white mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-2 md:p-3 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white" />
                </div>
                <div>
                    <label for="subject" class="block text-sm md:text-base font-medium text-white mb-1">Subjek
                        (opsional)</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-2 md:p-3 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white" />
                </div>
                <div>
                    <label for="message" class="block text-sm md:text-base font-medium text-white mb-1">Pesan</label>
                    <textarea id="message" name="message" rows="4" required
                        class="w-full bg-white/80 border border-gray-300 rounded-md p-2 md:p-3 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white">{{ old('message') }}</textarea>
                </div>
                <div class="flex justify-center">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                        data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                </div>
                <div>
                    <button type="submit" id="contactSubmitBtn" disabled
                        class="bg-secondary flex mx-auto text-white font-semibold px-8 md:px-10 py-2 md:py-3 text-sm md:text-base rounded-md transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-secondary/80 disabled:hover:bg-secondary">Kirim</button>
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