<section class="space-y-4 pb-20">

  {{-- HERO SECTION --}}
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex items-start justify-between gap-3">
      <div>
        <h3 class="font-bold text-gray-900">Hero Section</h3>
        <p class="text-xs text-gray-500 mt-1">
          Atur judul utama, subjudul, tombol CTA, dan background pada bagian paling atas landing page.
        </p>
      </div>
      <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-medium">
        Utama
      </span>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <label class="text-xs text-gray-500">Judul Hero</label>
        <input type="text" value="Riset & Inovasi Sistem Elektrikal"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Subjudul Hero</label>
        <input type="text" value="Solusi elektrikal modern berbasis riset untuk industri dan instansi."
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Teks Tombol CTA</label>
        <input type="text" value="Konsultasi Proyek"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Link Tombol CTA</label>
        <input type="text" value="/kontak"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="lg:col-span-1">
        <label class="text-xs text-gray-500">Background Hero (gambar)</label>
        <input type="file"
               class="mt-1 w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm" />
        <p class="text-[11px] text-gray-400 mt-2">
          Disarankan ukuran lebar minimal 1600px dengan rasio 16:9.
        </p>
      </div>

      <div class="lg:col-span-1 flex items-center gap-2">
        <input id="heroVisible" type="checkbox" checked class="h-4 w-4 accent-green-600" />
        <label for="heroVisible" class="text-sm text-gray-700">Tampilkan Hero di landing page</label>
      </div>
    </div>
  </div>

  {{-- LAYANAN / SOLUSI --}}
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-gray-900">Layanan / Solusi</h3>
      <p class="text-xs text-gray-500 mt-1">
        Atur judul section layanan dan highlight beberapa layanan utama yang muncul di landing page.
      </p>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <label class="text-xs text-gray-500">Judul Section</label>
        <input type="text" value="Layanan Utama"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Subjudul Section</label>
        <input type="text" value="Area riset dan pengembangan yang kami kerjakan untuk klien."
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="lg:col-span-2">
        <p class="text-xs text-gray-500 mb-2">Highlight Layanan</p>
        <p class="text-[11px] text-gray-400 -mt-1 mb-4">
          Isi 3–4 layanan yang akan tampil di halaman depan. Detail lengkap proyek bisa dikelola di menu lainnya.
        </p>
      </div>

      {{-- Layanan 1 --}}
      <div class="space-y-2">
        <label class="text-xs text-gray-500">Layanan 1</label>
        <input type="text" value="Riset & Pengembangan Sistem Elektrikal"
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        <textarea rows="3"
                  class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">Perancangan dan pengembangan sistem elektrikal untuk kebutuhan industri dan proyek khusus.</textarea>
      </div>

      {{-- Layanan 2 --}}
      <div class="space-y-2">
        <label class="text-xs text-gray-500">Layanan 2</label>
        <input type="text" value="Integrasi Otomasi & IoT"
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        <textarea rows="3"
                  class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">Menghubungkan perangkat, sensor, dan sistem kontrol untuk otomasi yang cerdas.</textarea>
      </div>

      {{-- Layanan 3 --}}
      <div class="space-y-2">
        <label class="text-xs text-gray-500">Layanan 3</label>
        <input type="text" value="Desain & Prototyping Perangkat Elektronik"
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        <textarea rows="3"
                  class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">Membantu tahap desain, pembuatan prototipe, dan pengujian perangkat elektronik.</textarea>
      </div>

      {{-- Layanan 4 --}}
      <div class="space-y-2">
        <label class="text-xs text-gray-500">Layanan 4 (opsional)</label>
        <input type="text" value="Analisis & Optimasi Sistem"
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        <textarea rows="3"
                  class="w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">Evaluasi performa sistem untuk meningkatkan efisiensi dan keandalan.</textarea>
      </div>
    </div>
  </div>

  {{-- PROYEK / PORTFOLIO --}}
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-gray-900">Proyek / Portfolio</h3>
      <p class="text-xs text-gray-500 mt-1">
        Atur judul dan pengaturan ringkas untuk section portfolio di landing page.
      </p>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <label class="text-xs text-gray-500">Judul Section</label>
        <input type="text" value="Portfolio & Proyek Kami"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Subjudul Section</label>
        <input type="text" value="Proyek-proyek terpilih yang telah kami kerjakan untuk klien."
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Jumlah proyek yang ditampilkan</label>
        <input type="number" value="4"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Link ke halaman portfolio lengkap</label>
        <input type="text" value="/portfolio"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>
    </div>
  </div>

  {{-- PARTNER / KERJASAMA --}}
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-gray-900">Partner / Kerjasama</h3>
      <p class="text-xs text-gray-500 mt-1">
        Atur teks utama untuk deretan logo perusahaan yang bekerja sama dengan CV. Global Electronic Solution.
      </p>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <label class="text-xs text-gray-500">Judul Section</label>
        <input type="text" value="Kerjasama"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Subjudul Section</label>
        <input type="text" value="Kami telah bekerja sama dengan berbagai perusahaan di Indonesia."
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="lg:col-span-2">
        <p class="text-[11px] text-gray-400">
          Data logo dan link partner bisa dikelola di halaman khusus Partner apabila diperlukan.
        </p>
      </div>
    </div>
  </div>

  {{-- SERTIFIKASI --}}
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-gray-900">Sertifikasi</h3>
      <p class="text-xs text-gray-500 mt-1">
        Atur tampilan section sertifikasi yang muncul sebelum footer.
      </p>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <label class="text-xs text-gray-500">Judul Section</label>
        <input type="text" value="Sertifikasi"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Subjudul Section</label>
        <input type="text" value="Standar mutu yang menjadi dasar kami dalam menjalankan proyek."
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="lg:col-span-2">
        <p class="text-xs text-gray-500 mb-2">Daftar Sertifikasi (ringkasan)</p>
        <p class="text-[11px] text-gray-400 -mt-1 mb-3">
          Detail sertifikat dapat diatur pada modul Sertifikasi jika dibutuhkan. Di landing page cukup tampil nama sertifikasi.
        </p>

        <div class="overflow-auto border border-gray-100 rounded-xl">
          <table class="min-w-full text-sm">
            <thead>
              <tr class="text-left text-xs text-gray-500 bg-gray-50">
                <th class="py-3 px-4">Nama Sertifikasi</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4">Berlaku Sampai</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-t border-gray-100">
                <td class="py-3 px-4">ISO 9001:2015</td>
                <td class="py-3 px-4">
                  <span class="inline-flex rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 text-xs">Aktif</span>
                </td>
                <td class="py-3 px-4">12 Des 2026</td>
              </tr>
              <tr class="border-t border-gray-100">
                <td class="py-3 px-4">ISO 14001:2015</td>
                <td class="py-3 px-4">
                  <span class="inline-flex rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 text-xs">Aktif</span>
                </td>
                <td class="py-3 px-4">30 Jun 2027</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- VISIBILITY --}}
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-gray-900">Visibility Section</h3>
      <p class="text-xs text-gray-500 mt-1">
        Atur section mana saja yang ingin ditampilkan di landing page.
      </p>
    </div>

    <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <p class="text-xs text-gray-500 mb-2">Tampilkan Section</p>
        <div class="space-y-2 text-sm text-gray-700">
          <label class="flex items-center gap-2">
            <input type="checkbox" checked class="h-4 w-4 accent-green-600">
            Hero
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" checked class="h-4 w-4 accent-green-600">
            Layanan
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" checked class="h-4 w-4 accent-green-600">
            Proyek / Portfolio
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" checked class="h-4 w-4 accent-green-600">
            Partner / Kerjasama
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" checked class="h-4 w-4 accent-green-600">
            Sertifikasi
          </label>
        </div>
      </div>

      <div>
        <p class="text-xs text-gray-500 mb-2">Catatan</p>
        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-700">
          Checklist di atas hanya mengatur apakah section muncul di landing page.
          Konten masing-masing section tetap tersimpan di sistem meskipun disembunyikan.
        </div>
      </div>
    </div>
  </div>

  {{-- FOOT ACTIONS --}}
  <div class="flex items-center justify-end gap-2 pt-2">
    <button type="button"
            onclick="alert('UI saja: preview belum dihubungkan.')"
            class="rounded-full bg-gray-200 px-4 py-2 text-sm text-gray-800 hover:bg-gray-300">
      Preview
    </button>
    <button type="button"
            onclick="alert('UI saja: perubahan belum disimpan ke database.')"
            class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
      Simpan Perubahan
    </button>
  </div>

</section>