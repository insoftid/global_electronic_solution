{{-- PROYEK / PORTFOLIO --}}
@php
  $projects = [
    [
      'id'=>1,
      'title'=>'Integrasi Sistem Otomasi Produksi',
      'subtitle'=>'Otomasi & IoT',
      'detail'=>'Integrasi sensor, PLC, dan dashboard monitoring untuk meningkatkan efisiensi lini produksi.',
      'date'=>'12 Jan 2026'
    ],
    [
      'id'=>2,
      'title'=>'Panel Kontrol & Monitoring Energi',
      'subtitle'=>'Monitoring',
      'detail'=>'Pembuatan panel kontrol serta sistem monitoring penggunaan energi berbasis web.',
      'date'=>'10 Jan 2026'
    ],
    [
      'id'=>3,
      'title'=>'Prototype Perangkat Elektronik Industri',
      'subtitle'=>'Prototyping',
      'detail'=>'Perancangan dan uji coba prototipe perangkat elektronik untuk kebutuhan industri khusus.',
      'date'=>'08 Jan 2026'
    ],
  ];
@endphp

<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
  <div class="px-5 py-4 border-b border-gray-100">
    <h3 class="font-bold text-gray-900">Proyek / Portfolio</h3>
    <p class="text-xs text-gray-500 mt-1">
      Kelola daftar proyek yang tampil di landing page. Klik item di kiri untuk edit di kanan. (UI saja)
    </p>
  </div>

  <div class="px-5 py-5 space-y-4">

    {{-- Judul section (tanpa subjudul) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <label class="text-xs text-gray-500">Judul Section</label>
        <input type="text" value="Portfolio & Proyek Kami"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div>
        <label class="text-xs text-gray-500">Jumlah proyek yang ditampilkan</label>
        <input type="number" value="4"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="lg:col-span-2">
        <label class="text-xs text-gray-500">Link ke halaman portfolio lengkap</label>
        <input type="text" value="/portfolio"
               class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
      </div>
    </div>

    {{-- GRID KIRI-KANAN --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

      {{-- KIRI: DAFTAR PROYEK --}}
      <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h4 class="font-semibold text-gray-900">Daftar Proyek</h4>
            <p class="text-xs text-gray-500 mt-1">Klik baris untuk edit di panel kanan.</p>
          </div>

          <div class="flex gap-2">
            <input id="projectSearch"
                   type="text"
                   placeholder="Cari judul..."
                   class="w-full sm:w-56 rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
          </div>
        </div>

        <div class="mt-3 overflow-auto">
          <table class="min-w-full text-sm">
            <thead>
              <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
                <th class="py-3 pr-3">Judul</th>
                <th class="py-3 pr-3">Subjudul</th>
                <th class="py-3">Tanggal</th>
              </tr>
            </thead>

            <tbody id="projectBody">
              @foreach($projects as $p)
              <tr
                class="project-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                data-id="{{ $p['id'] }}"
                data-title="{{ $p['title'] }}"
                data-subtitle="{{ $p['subtitle'] }}"
                data-detail="{{ $p['detail'] }}"
                data-date="{{ $p['date'] }}"
              >
                <td class="py-3 pr-3 font-medium text-gray-900">{{ $p['title'] }}</td>
                <td class="py-3 pr-3 text-gray-600">{{ $p['subtitle'] }}</td>
                <td class="py-3 text-gray-700">{{ $p['date'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div id="projectEmpty" class="hidden text-center py-10 text-sm text-gray-500">
            Proyek tidak ditemukan.
          </div>
        </div>
      </div>

      {{-- KANAN: FORM TAMBAH / EDIT --}}
      <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
        <div>
          <h4 class="font-semibold text-gray-900">Tambah / Edit Proyek</h4>
          <p class="text-xs text-gray-500 mt-1">Isi data di bawah lalu simpan. (UI saja)</p>
        </div>

        <form id="projectForm" class="mt-4 space-y-3" onsubmit="return false;">
          <input type="hidden" id="projectId" value="" />

          <div>
            <label class="text-xs text-gray-500">Judul Proyek</label>
            <input id="titleInput" type="text"
                   placeholder="Contoh: Integrasi Sistem Otomasi Produksi"
                   class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
          </div>

          <div>
            <label class="text-xs text-gray-500">Subjudul (singkat)</label>
            <input id="subtitleInput" type="text"
                   placeholder="Contoh: Otomasi & IoT"
                   class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
          </div>

          <div>
            <label class="text-xs text-gray-500">Detail Proyek</label>
            <textarea id="detailInput" rows="4"
                      placeholder="Jelaskan ringkas detail proyek: tujuan, scope, hasil, dll."
                      class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
          </div>

          <div>
            <label class="text-xs text-gray-500">Upload Gambar Kegiatan</label>
            <input id="imageInput" type="file"
                   class="mt-1 w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm" />
            <p class="text-[11px] text-gray-400 mt-2">*UI saja, file belum tersimpan.</p>
          </div>

          <div class="flex items-center justify-end gap-2 pt-2">
            <button type="button" id="projResetBtn"
                    class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
              Reset
            </button>

            <button type="button" id="projDeleteBtn"
                    class="rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
              Hapus
            </button>

            <button type="button" id="projSaveBtn"
                    class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
              Simpan
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

{{-- SERTIFIKASI --}}
@php
  $certs = [
    ['id'=>1,'name'=>'ISO 9001:2015','file'=>'iso-9001.jpg'],
    ['id'=>2,'name'=>'ISO 14001:2015','file'=>'iso-14001.jpg'],
  ];
@endphp

<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mt-6">
  <div class="px-5 py-4 border-b border-gray-100">
    <h3 class="font-bold text-gray-900">Sertifikasi</h3>
    <p class="text-xs text-gray-500 mt-1">
      Kiri: daftar sertifikasi. Kanan: tambah/edit sertifikasi + upload sertifikat. (UI saja)
    </p>
  </div>

  <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-12 gap-4">

    {{-- KIRI: DAFTAR --}}
    <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
      <div class="flex items-center justify-between gap-2">
        <div>
          <h4 class="font-semibold text-gray-900">Daftar Sertifikasi</h4>
          <p class="text-xs text-gray-500 mt-1">Klik baris untuk edit di kanan.</p>
        </div>

        <input id="certSearch" type="text" placeholder="Cari sertifikasi..."
               class="w-56 rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="mt-3 overflow-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
              <th class="py-3 pr-3">Nama</th>
              <th class="py-3">File</th>
            </tr>
          </thead>

          <tbody id="certBody">
            @foreach($certs as $c)
            <tr class="cert-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                data-id="{{ $c['id'] }}"
                data-name="{{ $c['name'] }}"
                data-file="{{ $c['file'] }}">
              <td class="py-3 pr-3 font-medium text-gray-900">{{ $c['name'] }}</td>
              <td class="py-3 text-gray-600">{{ $c['file'] }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div id="certEmpty" class="hidden text-center py-10 text-sm text-gray-500">
          Sertifikasi tidak ditemukan.
        </div>
      </div>
    </div>

    {{-- KANAN: FORM TAMBAH / EDIT --}}
    <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
      <div>
        <h4 class="font-semibold text-gray-900">Tambah / Edit Sertifikasi</h4>
        <p class="text-xs text-gray-500 mt-1">Isi data lalu simpan. (UI saja)</p>
      </div>

      <form class="mt-4 space-y-3" onsubmit="return false;">
        <input type="hidden" id="certId" value="" />

        <div>
          <label class="text-xs text-gray-500">Nama Sertifikasi</label>
          <input id="certName" type="text" placeholder="Contoh: ISO 9001:2015"
                 class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        </div>

        <div>
          <label class="text-xs text-gray-500">Upload Gambar Sertifikat</label>
          <input id="certFile" type="file"
                 class="mt-1 w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm" />
          <p id="certFileInfo" class="text-[11px] text-gray-400 mt-2">Belum ada file dipilih.</p>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
          <button type="button" id="certReset"
                  class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
            Reset
          </button>

          <button type="button" id="certDelete"
                  class="rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
            Hapus
          </button>

          <button type="button" id="certSave"
                  class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
            Simpan
          </button>
        </div>
      </form>
    </div>

  </div>
</div>

{{-- PARTNER / KERJASAMA --}}
@php
  $partners = [
    ['id'=>1,'name'=>'IndoFood','file'=>'logo-indofood.png'],
    ['id'=>2,'name'=>'Putra Karya Baja','file'=>'logo-pkb.png'],
    ['id'=>3,'name'=>'BK Foundation','file'=>'logo-bk.png'],
  ];
@endphp

<div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mt-6">
  <div class="px-5 py-4 border-b border-gray-100">
    <h3 class="font-bold text-gray-900">Partner / Kerjasama</h3>
    <p class="text-xs text-gray-500 mt-1">
      Kiri: daftar partner. Kanan: tambah/edit partner + upload logo. (UI saja)
    </p>
  </div>

  <div class="px-5 py-5 grid grid-cols-1 lg:grid-cols-12 gap-4">

    {{-- KIRI: DAFTAR --}}
    <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
      <div class="flex items-center justify-between gap-2">
        <div>
          <h4 class="font-semibold text-gray-900">Daftar Partner</h4>
          <p class="text-xs text-gray-500 mt-1">Klik baris untuk edit di kanan.</p>
        </div>

        <input id="partnerSearch" type="text" placeholder="Cari partner..."
               class="w-56 rounded-xl border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-200" />
      </div>

      <div class="mt-3 overflow-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
              <th class="py-3 pr-3">Nama</th>
              <th class="py-3">File</th>
            </tr>
          </thead>

          <tbody id="partnerBody">
            @foreach($partners as $p)
            <tr class="partner-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                data-id="{{ $p['id'] }}"
                data-name="{{ $p['name'] }}"
                data-file="{{ $p['file'] }}">
              <td class="py-3 pr-3 font-medium text-gray-900">{{ $p['name'] }}</td>
              <td class="py-3 text-gray-600">{{ $p['file'] }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div id="partnerEmpty" class="hidden text-center py-10 text-sm text-gray-500">
          Partner tidak ditemukan.
        </div>
      </div>
    </div>

    {{-- KANAN: FORM TAMBAH / EDIT --}}
    <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
      <div>
        <h4 class="font-semibold text-gray-900">Tambah / Edit Partner</h4>
        <p class="text-xs text-gray-500 mt-1">Isi data lalu simpan. (UI saja)</p>
      </div>

      <form class="mt-4 space-y-3" onsubmit="return false;">
        <input type="hidden" id="partnerId" value="" />

        <div>
          <label class="text-xs text-gray-500">Nama Partner</label>
          <input id="partnerName" type="text" placeholder="Contoh: IndoFood"
                 class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        </div>

        <div>
          <label class="text-xs text-gray-500">Upload Logo / Gambar</label>
          <input id="partnerFile" type="file"
                 class="mt-1 w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm" />
          <p id="partnerFileInfo" class="text-[11px] text-gray-400 mt-2">Belum ada file dipilih.</p>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
          <button type="button" id="partnerReset"
                  class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
            Reset
          </button>

          <button type="button" id="partnerDelete"
                  class="rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
            Hapus
          </button>

          <button type="button" id="partnerSave"
                  class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
            Simpan
          </button>
        </div>
      </form>
    </div>

  </div>
</div>

{{-- UI-only JS --}}
<script>
(function () {

  /* =====================================================
     HELPER UMUM
     ===================================================== */
  function setActive(rows, row){
    rows.forEach(r => r.classList.remove('ring-2','ring-green-200','bg-green-50'));
    if(row) row.classList.add('ring-2','ring-green-200','bg-green-50');
  }

  function applySearch(rows, query, emptyEl, matcher){
    const q = (query || '').toLowerCase().trim();
    let visible = 0;

    rows.forEach(row => {
      const text = matcher(row).toLowerCase();
      const show = !q || text.includes(q);
      row.style.display = show ? '' : 'none';
      if(show) visible++;
    });

    if(emptyEl) emptyEl.classList.toggle('hidden', visible !== 0);
  }

  /* =====================================================
     1️⃣ PROYEK / PORTFOLIO
     ===================================================== */
  (function(){
    const rows = Array.from(document.querySelectorAll('.project-row'));

    const search = document.getElementById('projectSearch');
    const empty  = document.getElementById('projectEmpty');

    const idEl    = document.getElementById('projectId');
    const titleEl = document.getElementById('titleInput');
    const subEl   = document.getElementById('subtitleInput');
    const detEl   = document.getElementById('detailInput');
    const imgEl   = document.getElementById('imageInput');

    const btnReset  = document.getElementById('projResetBtn');
    const btnDelete = document.getElementById('projDeleteBtn');
    const btnSave   = document.getElementById('projSaveBtn');

    function fill(row){
      idEl.value = row.dataset.id || '';
      titleEl.value = row.dataset.title || '';
      subEl.value = row.dataset.subtitle || '';
      detEl.value = row.dataset.detail || '';
      imgEl.value = '';
    }

    rows.forEach(row => {
      row.addEventListener('click', () => {
        setActive(rows, row);
        fill(row);
      });
    });

    search.addEventListener('input', () => {
      applySearch(rows, search.value, empty,
        r => (r.dataset.title || '') + ' ' + (r.dataset.subtitle || '')
      );
    });

    btnReset.addEventListener('click', () => {
      setActive(rows, null);
      idEl.value = titleEl.value = subEl.value = detEl.value = '';
      imgEl.value = '';
      search.value = '';
      applySearch(rows, '', empty, r => r.dataset.title || '');
    });

    btnSave.addEventListener('click', () => {
      alert('UI saja: Simpan proyek belum terhubung ke database.');
    });

    btnDelete.addEventListener('click', () => {
      if(!idEl.value){
        alert('Pilih proyek dulu dari tabel sebelum menghapus.');
        return;
      }
      const row = document.querySelector(`.project-row[data-id="${idEl.value}"]`);
      if(row) row.remove();
      btnReset.click();
      alert('UI saja: proyek dihapus dari tampilan.');
    });

    if(rows[0]){
      setActive(rows, rows[0]);
      fill(rows[0]);
    }
  })();

  /* =====================================================
     2️⃣ PARTNER / KERJASAMA
     ===================================================== */
  (function(){
    const rows = Array.from(document.querySelectorAll('.partner-row'));

    const search = document.getElementById('partnerSearch');
    const empty  = document.getElementById('partnerEmpty');

    const idEl   = document.getElementById('partnerId');
    const nameEl = document.getElementById('partnerName');
    const fileEl = document.getElementById('partnerFile');
    const infoEl = document.getElementById('partnerFileInfo');

    const btnReset  = document.getElementById('partnerReset');
    const btnDelete = document.getElementById('partnerDelete');
    const btnSave   = document.getElementById('partnerSave');

    function fill(row){
      idEl.value = row.dataset.id || '';
      nameEl.value = row.dataset.name || '';
      fileEl.value = '';
      infoEl.textContent = row.dataset.file
        ? `File saat ini: ${row.dataset.file}`
        : 'Belum ada file dipilih.';
    }

    rows.forEach(row => {
      row.addEventListener('click', () => {
        setActive(rows, row);
        fill(row);
      });
    });

    search.addEventListener('input', () => {
      applySearch(rows, search.value, empty, r => r.dataset.name || '');
    });

    btnReset.addEventListener('click', () => {
      setActive(rows, null);
      idEl.value = nameEl.value = '';
      fileEl.value = '';
      infoEl.textContent = 'Belum ada file dipilih.';
      search.value = '';
      applySearch(rows, '', empty, r => r.dataset.name || '');
    });

    btnSave.addEventListener('click', () => {
      alert('UI saja: Simpan partner belum terhubung ke database.');
    });

    btnDelete.addEventListener('click', () => {
      if(!idEl.value){
        alert('Pilih partner dulu dari tabel sebelum menghapus.');
        return;
      }
      const row = document.querySelector(`.partner-row[data-id="${idEl.value}"]`);
      if(row) row.remove();
      btnReset.click();
      alert('UI saja: partner dihapus dari tampilan.');
    });

    if(rows[0]){
      setActive(rows, rows[0]);
      fill(rows[0]);
    }
  })();

  /* =====================================================
     3️⃣ SERTIFIKASI
     ===================================================== */
  (function(){
    const rows = Array.from(document.querySelectorAll('.cert-row'));

    const search = document.getElementById('certSearch');
    const empty  = document.getElementById('certEmpty');

    const idEl   = document.getElementById('certId');
    const nameEl = document.getElementById('certName');
    const fileEl = document.getElementById('certFile');
    const infoEl = document.getElementById('certFileInfo');

    const btnReset  = document.getElementById('certReset');
    const btnDelete = document.getElementById('certDelete');
    const btnSave   = document.getElementById('certSave');

    function fill(row){
      idEl.value = row.dataset.id || '';
      nameEl.value = row.dataset.name || '';
      fileEl.value = '';
      infoEl.textContent = row.dataset.file
        ? `File saat ini: ${row.dataset.file}`
        : 'Belum ada file dipilih.';
    }

    rows.forEach(row => {
      row.addEventListener('click', () => {
        setActive(rows, row);
        fill(row);
      });
    });

    search.addEventListener('input', () => {
      applySearch(rows, search.value, empty, r => r.dataset.name || '');
    });

    btnReset.addEventListener('click', () => {
      setActive(rows, null);
      idEl.value = nameEl.value = '';
      fileEl.value = '';
      infoEl.textContent = 'Belum ada file dipilih.';
      search.value = '';
      applySearch(rows, '', empty, r => r.dataset.name || '');
    });

    btnSave.addEventListener('click', () => {
      alert('UI saja: Simpan sertifikasi belum terhubung ke database.');
    });

    btnDelete.addEventListener('click', () => {
      if(!idEl.value){
        alert('Pilih sertifikasi dulu dari tabel sebelum menghapus.');
        return;
      }
      const row = document.querySelector(`.cert-row[data-id="${idEl.value}"]`);
      if(row) row.remove();
      btnReset.click();
      alert('UI saja: sertifikasi dihapus dari tampilan.');
    });

    if(rows[0]){
      setActive(rows, rows[0]);
      fill(rows[0]);
    }
  })();

})();
</script>