<section>
    <div class="space-y-6">
        <!-- Top metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Pesan Kontak Baru</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">{{ $stats['newMessages'] ?? 0 }}</div>
                <div class="mt-2 text-sm text-green-500">• Belum dibaca</div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Proyek Published</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">{{ $stats['totalPortfolios'] ?? 0 }}</div>
                <div class="mt-2 text-sm text-green-500">• Aktif</div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Sertifikasi Aktif</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">{{ $stats['totalCertificates'] ?? 0 }}</div>
                <div class="mt-2 text-sm text-gray-500">• Tersimpan</div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <div class="text-sm text-gray-500">Partner Aktif</div>
                <div class="mt-2 text-3xl font-semibold text-gray-800">{{ $stats['totalPartners'] ?? 0 }}</div>
                <div class="mt-2 text-sm text-green-500">• Terdaftar</div>
            </div>
        </div>

        <!-- Main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Ringkasan Landing Page (spans 2 cols on large screens) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Ringkasan Landing Page</h3>
                    <a href="{{ route('admin.landing-page') }}" class="text-sm text-green-500 hover:underline">Kelola
                        Landing Page</a>
                </div>

                <div class="mt-4 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="sr-only">
                            <tr>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Item Aktif</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Hero</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">1</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Proyek / Portofolio</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $stats['totalPortfolios'] ?? 0 }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Partner / Klien</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $stats['totalPartners'] ?? 0 }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class="px-4 py-3 text-gray-700">Sertifikasi</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-medium">Aktif</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $stats['totalCertificates'] ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.landing-page') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow-sm text-sm hover:bg-green-700">Edit
                        Landing Page</a>
                    <a href="{{ route('admin.settings') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">Pengaturan
                        Website</a>
                    <a href="{{ route('admin.contacts.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">Lihat
                        Kontak Masuk</a>
                </div>
            </div>

            <!-- Right: Kontak Masuk Terbaru -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Kontak Masuk Terbaru</h3>
                    <a href="{{ route('admin.contacts.index') }}" class="text-sm text-green-500 hover:underline">Lihat
                        semua</a>
                </div>

                <ul class="mt-4 space-y-4">
                    @forelse($recentContacts ?? [] as $contact)
                        <li class="flex items-start gap-3">
                            <div
                                class="shrink-0 h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center font-semibold">
                                {{ strtoupper(substr($contact->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-800">{{ $contact->name }}</div>
                                <div class="text-sm text-gray-600 truncate">{{ Str::limit($contact->message, 50) }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $contact->created_at->diffForHumans() }} •
                                    Status: {{ $contact->status }}</div>
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500 py-4">Belum ada pesan masuk</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>