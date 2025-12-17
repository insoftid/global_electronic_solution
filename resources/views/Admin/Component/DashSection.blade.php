<section>
    <div class="space-y-6">
        <!-- Top metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Pesan Kontak Baru</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">8</div>
                <div class="mt-2 text-sm text-green-500">↗ +3 minggu ini</div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Proyek Published</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">12</div>
                <div class="mt-2 text-sm text-green-500">↗ +2 bulan ini</div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Sertifikasi Aktif</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">4</div>
                <div class="mt-2 text-sm text-gray-500">• update 3 bln lalu</div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Partner Aktif</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">6</div>
                <div class="mt-2 text-sm text-green-500">↗ +1 bulan ini</div>
            </div>
        </div>

        <!-- Main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Ringkasan Landing Page (spans 2 cols on large screens) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Ringkasan Landing Page</h3>
                    <a href="#" class="text-sm text-green-500 hover:underline">Kelola Landing Page</a>
                </div>

                <div class="mt-4 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="sr-only">
                            <tr><th>Section</th><th>Status</th><th>Item Aktif</th></tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Hero</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">1</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Layanan / Solusi</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">3</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Proyek / Portofolio</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium">Sebagian</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">4</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Partner / Klien</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">6</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Sertifikasi</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">4</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex gap-3">
                    <a href="/admin/landing" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow-sm text-sm hover:bg-green-700">Edit Landing Page</a>
                    <a href="/admin/settings" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">Pengaturan Website</a>
                    <a href="/admin/contacts" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">Lihat Kontak Masuk</a>
                </div>
            </div>

            <!-- Right: Kontak Masuk Terbaru -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Kontak Masuk Terbaru</h3>
                    <a href="/admin/contacts" class="text-sm text-green-500 hover:underline">Lihat semua</a>
                </div>

                @php
                    $contacts = [
                        ['initials' => 'AR', 'name' => 'Andri Rahman', 'message' => 'mengirim permintaan penawaran sistem otomasi.', 'time' => '1 jam lalu', 'status' => 'Baru'],
                        ['initials' => 'LS', 'name' => 'Lestari Sejahtera', 'message' => 'menanyakan integrasi IoT untuk pabrik.', 'time' => '4 jam lalu', 'status' => 'Dibaca'],
                        ['initials' => 'IP', 'name' => 'Indo Power Group', 'message' => 'mengirim follow up terkait proposal.', 'time' => 'Kemarin', 'status' => 'Dibalas'],
                    ];
                @endphp

                <ul class="mt-4 space-y-4">
                    @foreach($contacts as $c)
                        <li class="flex items-start gap-3">
                            <div class="shrink-0 h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center font-semibold">{{ $c['initials'] }}</div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-800">{{ $c['name'] }}</div>
                                <div class="text-sm text-gray-600">{{ $c['message'] }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $c['time'] }} • Status: {{ $c['status'] }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>