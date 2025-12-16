<section>
    <div class="flex gap-5">
        <div class="bg-white rounded-xl shadow-lg w-5/8">
            <div class="p-5 border-b border-gray-300">
                <h2 class="font-bold text-lg">Identitas Website</h2>
                <span class="text-sm font-base text-graytext">Mengubah data utama yang tampil di Header, Footer, dan Halaman Kontak</span>
            </div>
            <form action="POST">
                <div class="flex p-5 gap-5">
                    <div class="flex-col w-1/2">
                        <div class="mb-5">
                            <label for="Nama" class="font-bold text-md">Nama Perusahaan</label>
                            <input id="Nama" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="CV. Global Electronic Solution">
                        </div>
                        <div>
                            <label class="font-bold text-md" for="logo_input">Logo</label>
                            <div class="my-2 w-full h-9 rounded-lg border border-gray-300 justify-between items-center inline-flex">
                            <h2 class="text-gray-900/20 text-sm font-normal leading-snug pl-4">No file chosen</h2>
                            <input type="file" hidden />
                            <div class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Choose File </div>
                        </div>
                            <p class="text-[10px] text-graytext" id="logo_input_help">SVG, PNG or JPG (Max 2 MB).</p>
                        </div>
                    </div>
                    <div class="flex-col w-1/2">
                        <div class="mb-5">
                            <label for="Nama" class="font-bold text-md">Tagline</label>
                            <input id="Nama" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="CV. Global Electronic Solution">
                        </div>
                        <div>
                            <label class="font-bold text-md" for="logo_input">Favicon</label>
                            <div class="my-2 w-full h-9 rounded-lg border border-gray-300 justify-between items-center inline-flex">
                            <h2 class="text-gray-900/20 text-sm font-normal leading-snug pl-4">No file chosen</h2>
                            <input type="file" hidden />
                            <div class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Choose File </div>
                        </div>
                            <p class="text-[10px] text-graytext" id="logo_input_help">SVG, PNG or JPG (Max 2 MB).</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-5 gap-3">
                    <a href="/admin/settings" class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit" class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Submit</button>
                </div>
            </form>
        </div>
        <div class="bg-white rounded-xl shadow-lg w-3/8">
            <div class="p-5 border-b border-gray-300">
                <h2 class="font-bold text-lg">Kontak & Sosial</h2>
                <span class="text-sm font-base text-graytext">Dipakai untuk footer dan halaman kontak.</span>
            </div>
            <form action="POST">
                <div class="flex p-5 gap-5">
                    <div class="flex-col w-1/2">
                        <div>
                            <label for="Email" class="font-bold text-md">Email</label>
                            <input id="Email" type="email" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="cs@globalelectronicsolution.com">
                        </div>
                    </div>
                    <div class="flex-col w-1/2">
                        <div>
                            <label for="WhatsApp" class="font-bold text-md">WhatsApp</label>
                            <input id="WhatsApp" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="+6282120205757">
                        </div>
                    </div>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="alamat" class="font-bold text-md">Alamat</label>
                    <textarea id="alamat" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">Jl. Gondang Timur II No. 2, Kel. Bulusan, Kec. Tembalang, Kota Semarang, Jawa Tengah, Indonesia 50277</textarea>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="maps" class="font-bold text-md">Google Maps</label>
                    <input id="maps" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://goo.gl/maps/example">
                    <p class="text-[10px] text-graytext" id="logo_input_help">Link digunakan untuk menampilkan lokasi pada halaman kontak.</p>
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="ig" class="font-bold text-md">Instagram</label>
                    <input id="ig" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://instagram.com/example">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="tiktok" class="font-bold text-md">TikTok</label>
                    <input id="tiktok" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://tiktok.com/example">
                </div>
                <div class="mx-5 mb-2.5">
                    <label for="youtube" class="font-bold text-md">YouTube</label>
                    <input id="maps" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://goo.gl/maps/example">
                </div>
                <div class="flex justify-end p-5 gap-3">
                    <a href="/admin/settings" class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                    <button type="submit" class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg w-full mt-5">
        <div class="p-5 border-b border-gray-300">
            <h2 class="font-bold text-lg">Kontak & Sosial</h2>
            <span class="text-sm font-base text-graytext">Dipakai untuk footer dan halaman kontak.</span>
        </div>
        <form action="POST">
            <div class="flex p-5 gap-5">
                <div class="flex-col w-1/2">
                    <div>
                        <label for="Email" class="font-bold text-md">Email</label>
                        <input id="Email" type="email" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="cs@globalelectronicsolution.com">
                    </div>
                </div>
                <div class="flex-col w-1/2">
                    <div>
                        <label for="WhatsApp" class="font-bold text-md">WhatsApp</label>
                        <input id="WhatsApp" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="+6282120205757">
                    </div>
                </div>
            </div>
            <div class="mx-5 mb-2.5">
                <label for="alamat" class="font-bold text-md">Alamat</label>
                <textarea id="alamat" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1 h-24">Jl. Gondang Timur II No. 2, Kel. Bulusan, Kec. Tembalang, Kota Semarang, Jawa Tengah, Indonesia 50277</textarea>
            </div>
            <div class="mx-5 mb-2.5">
                <label for="maps" class="font-bold text-md">Google Maps</label>
                <input id="maps" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://goo.gl/maps/example">
                <p class="text-[10px] text-graytext" id="logo_input_help">Link digunakan untuk menampilkan lokasi pada halaman kontak.</p>
            </div>
            <div class="mx-5 mb-2.5">
                <label for="ig" class="font-bold text-md">Instagram</label>
                <input id="ig" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://instagram.com/example">
            </div>
            <div class="mx-5 mb-2.5">
                <label for="tiktok" class="font-bold text-md">TikTok</label>
                <input id="tiktok" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://tiktok.com/example">
            </div>
            <div class="mx-5 mb-2.5">
                <label for="youtube" class="font-bold text-md">YouTube</label>
                <input id="maps" type="text" class="border border-gray-400 rounded-lg px-2 py-1 w-full mt-1" value="https://goo.gl/maps/example">
            </div>
            <div class="flex justify-end p-5 gap-3">
                <a href="/admin/settings" class="border rounded-lg border-gray-200 text-gray-800 font-medium py-1 px-5 text-sm">Reset</a>
                <button type="submit" class="rounded-lg text-white font-medium py-1 px-5 text-sm bg-secondary">Submit</button>
            </div>
        </form>
    </div>
</section>