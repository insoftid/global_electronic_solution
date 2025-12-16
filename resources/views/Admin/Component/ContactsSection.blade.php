@php
  $messages = [
    [
      'id'=>1,
      'name'=>'Indira Sari',
      'email'=>'indira@indofood.co.id',
      'subject'=>'Permintaan presentasi sistem otomasi',
      'status'=>'Baru',
      'date'=>'12 Jan 2026',
      'content'=>'Halo tim Global Electronic Solution, kami tertarik untuk menjadwalkan presentasi terkait solusi otomasi lini produksi di pabrik kami di Kendal. Mohon info jadwal yang tersedia dalam dua minggu ke depan.'
    ],
    [
      'id'=>2,
      'name'=>'Dr. Bambang Susilo',
      'email'=>'bambang@putrakaryabaja.co.id',
      'subject'=>'Update progres integrasi panel kontrol',
      'status'=>'Dibaca',
      'date'=>'10 Jan 2026',
      'content'=>'Mohon update terkait progres integrasi panel kontrol untuk project kami. Apakah sudah bisa dilakukan uji coba minggu ini?'
    ],
    [
      'id'=>3,
      'name'=>'Theresia Kartika W.',
      'email'=>'theresia@indonesianpeoplepower.com',
      'subject'=>'Diskusi awal pengembangan sistem monitoring energi',
      'status'=>'Dibalas',
      'date'=>'08 Jan 2026',
      'content'=>'Kami ingin diskusi awal tentang sistem monitoring energi. Apakah bisa dijadwalkan meeting online?'
    ],
    [
      'id'=>4,
      'name'=>'Arief Khristanto',
      'email'=>'arief@bkfoundation.org',
      'subject'=>'Kolaborasi riset pengelolaan energi untuk fasilitas pengolahan sampah',
      'status'=>'Dibaca',
      'date'=>'05 Jan 2026',
      'content'=>'Kami tertarik kolaborasi riset pengelolaan energi untuk fasilitas pengolahan sampah. Mohon info PIC untuk koordinasi.'
    ],
  ];
@endphp

<section class="space-y-4">

  {{-- TOP BAR --}}
  <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
    <div class="flex flex-col sm:flex-row gap-3 w-full">
      <input id="searchMsg"
             type="text"
             placeholder="Cari nama, email, atau subjek..."
             class="w-full sm:w-96 rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />

      <select id="statusFilter"
              class="w-full sm:w-52 rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
        <option value="all">Semua Status</option>
        <option value="Baru">Baru</option>
        <option value="Dibaca">Dibaca</option>
        <option value="Dibalas">Dibalas</option>
      </select>
    </div>

    <div class="ml-auto inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-2 text-xs text-gray-600">
      <span>Total:</span>
      <span id="totalMsg" class="font-semibold">{{ count($messages) }}</span>
      <span>pesan</span>
    </div>
  </div>

  {{-- GRID --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

    {{-- LEFT: TABLE --}}
    <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
      <div>
        <h3 class="font-bold text-gray-900">Daftar Pesan</h3>
        <p class="text-xs text-gray-500 mt-1">
          Pesan yang dikirim dari form kontak di website. Klik baris untuk melihat detail.
        </p>
      </div>

      <div class="mt-3 overflow-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
              <th class="py-3 pr-3">Nama</th>
              <th class="py-3 pr-3">Email</th>
              <th class="py-3 pr-3">Subjek</th>
              <th class="py-3 pr-3">Status</th>
              <th class="py-3">Tanggal</th>
            </tr>
          </thead>

          <tbody id="msgBody">
            @foreach($messages as $m)
            <tr
              class="msg-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
              data-id="{{ $m['id'] }}"
              data-name="{{ $m['name'] }}"
              data-email="{{ $m['email'] }}"
              data-subject="{{ $m['subject'] }}"
              data-status="{{ $m['status'] }}"
              data-date="{{ $m['date'] }}"
              data-content="{{ $m['content'] }}"
            >
              <td class="py-3 pr-3 font-medium text-gray-900">{{ $m['name'] }}</td>
              <td class="py-3 pr-3 text-gray-600">{{ $m['email'] }}</td>
              <td class="py-3 pr-3 text-gray-700">{{ $m['subject'] }}</td>
              <td class="py-3 pr-3">
                @if($m['status']==='Baru')
                  <span class="inline-flex rounded-full bg-red-100 text-red-700 px-2.5 py-1 text-xs">Baru</span>
                @elseif($m['status']==='Dibalas')
                  <span class="inline-flex rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 text-xs">Dibalas</span>
                @else
                  <span class="inline-flex rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs">Dibaca</span>
                @endif
              </td>
              <td class="py-3 text-gray-700">{{ $m['date'] }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div id="emptyStateMsg" class="hidden text-center py-10 text-sm text-gray-500">
          Pesan tidak ditemukan.
        </div>
      </div>
    </div>

    {{-- RIGHT: DETAIL --}}
    <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
      <div class="border-b border-gray-100 pb-3">
        <h3 id="detailSubject" class="font-bold text-gray-900">Pilih pesan untuk melihat detail</h3>
        <p class="text-xs text-gray-500 mt-1">
          Dari <span id="detailName">-</span> • <span id="detailEmail">-</span>
        </p>
      </div>

      <div class="py-3 text-sm text-gray-700 space-y-2">
        <div class="flex flex-wrap gap-4">
          <div><span class="text-gray-500 text-xs">Nama:</span> <span id="dName" class="font-medium">-</span></div>
          <div><span class="text-gray-500 text-xs">Email:</span> <span id="dEmail" class="font-medium">-</span></div>
        </div>
        <div class="flex flex-wrap gap-4">
          <div><span class="text-gray-500 text-xs">Tanggal:</span> <span id="dDate" class="font-medium">-</span></div>
          <div>
            <span class="text-gray-500 text-xs">Status:</span>
            <span id="dStatusBadge" class="inline-flex rounded-full bg-gray-200 text-gray-700 px-2.5 py-1 text-xs">-</span>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-100 pt-3">
        <p class="text-xs text-gray-500 mb-2">Isi Pesan</p>
        <div id="dContent" class="text-sm text-gray-700 leading-relaxed">
          -
        </div>
      </div>

      <div class="border-t border-gray-100 mt-4 pt-4 space-y-3">
        <div>
          <label class="text-xs text-gray-500">Ubah Status</label>
          <select id="statusUpdate"
                  class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
            <option value="Baru">Baru</option>
            <option value="Dibaca">Dibaca</option>
            <option value="Dibalas">Dibalas</option>
          </select>
        </div>

        <div>
          <label class="text-xs text-gray-500">Catatan Admin</label>
          <textarea id="adminNote"
                    rows="4"
                    placeholder="Contoh: sudah dihubungi via telepon, menunggu dokumen tambahan."
                    class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200"></textarea>
        </div>

        <div class="flex justify-end gap-2">
          <button id="markReadBtn"
                  type="button"
                  class="rounded-full bg-gray-200 px-4 py-2 text-sm text-gray-800 hover:bg-gray-300">
            Tandai Dibaca
          </button>
          <button id="saveContactBtn"
                  type="button"
                  class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
            Simpan
          </button>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
(function () {
  function getRows(){ return Array.from(document.querySelectorAll('.msg-row')); }

  const searchMsg = document.getElementById('searchMsg');
  const statusFilter = document.getElementById('statusFilter');
  const totalMsg = document.getElementById('totalMsg');
  const emptyStateMsg = document.getElementById('emptyStateMsg');

  // Detail elements
  const detailSubject = document.getElementById('detailSubject');
  const detailName = document.getElementById('detailName');
  const detailEmail = document.getElementById('detailEmail');
  const dName = document.getElementById('dName');
  const dEmail = document.getElementById('dEmail');
  const dDate = document.getElementById('dDate');
  const dContent = document.getElementById('dContent');
  const dStatusBadge = document.getElementById('dStatusBadge');
  const statusUpdate = document.getElementById('statusUpdate');
  const adminNote = document.getElementById('adminNote');
  const markReadBtn = document.getElementById('markReadBtn');
  const saveContactBtn = document.getElementById('saveContactBtn');

  let selectedRow = null;

  function setBadge(status){
    dStatusBadge.className = 'inline-flex rounded-full px-2.5 py-1 text-xs';
    if(status === 'Baru'){
      dStatusBadge.classList.add('bg-red-100','text-red-700');
    } else if(status === 'Dibalas'){
      dStatusBadge.classList.add('bg-emerald-100','text-emerald-700');
    } else {
      dStatusBadge.classList.add('bg-sky-100','text-sky-700');
    }
    dStatusBadge.textContent = status;
  }

  function clearActive(){
    getRows().forEach(r => r.classList.remove('ring-2','ring-green-200','bg-green-50'));
  }

  function fillDetail(row){
    selectedRow = row;

    detailSubject.textContent = row.dataset.subject || '-';
    detailName.textContent = row.dataset.name || '-';
    detailEmail.textContent = row.dataset.email || '-';

    dName.textContent = row.dataset.name || '-';
    dEmail.textContent = row.dataset.email || '-';
    dDate.textContent = row.dataset.date || '-';
    dContent.textContent = row.dataset.content || '-';

    const st = row.dataset.status || 'Dibaca';
    statusUpdate.value = st;
    setBadge(st);
  }

  function bindRows(){
    getRows().forEach(row => {
      row.addEventListener('click', () => {
        clearActive();
        row.classList.add('ring-2','ring-green-200','bg-green-50');
        fillDetail(row);
      });
    });
  }

  function applyFilter(){
    const q = (searchMsg.value || '').toLowerCase().trim();
    const st = statusFilter.value;

    let visible = 0;
    getRows().forEach(row => {
      const name = (row.dataset.name || '').toLowerCase();
      const email = (row.dataset.email || '').toLowerCase();
      const subject = (row.dataset.subject || '').toLowerCase();
      const rowStatus = row.dataset.status || '';

      const matchText = !q || name.includes(q) || email.includes(q) || subject.includes(q);
      const matchStatus = (st === 'all') || (rowStatus === st);

      const show = matchText && matchStatus;
      row.style.display = show ? '' : 'none';
      if(show) visible++;
    });

    totalMsg.textContent = visible;
    emptyStateMsg.classList.toggle('hidden', visible !== 0);
  }

  searchMsg.addEventListener('input', applyFilter);
  statusFilter.addEventListener('change', applyFilter);

  markReadBtn.addEventListener('click', () => {
    if(!selectedRow){ alert('Pilih pesan dulu.'); return; }
    selectedRow.dataset.status = 'Dibaca';
    // update badge di tabel: paling simpel refresh page, tapi kita update tampilan badge row secara cepat
    const badge = selectedRow.querySelector('td:nth-child(4) span');
    if(badge){
      badge.className = 'inline-flex rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs';
      badge.textContent = 'Dibaca';
    }
    statusUpdate.value = 'Dibaca';
    setBadge('Dibaca');
    applyFilter();
  });

  saveContactBtn.addEventListener('click', () => {
    if(!selectedRow){ alert('Pilih pesan dulu.'); return; }
    // UI-only: update status dari dropdown
    const newStatus = statusUpdate.value;
    selectedRow.dataset.status = newStatus;

    const badge = selectedRow.querySelector('td:nth-child(4) span');
    if(badge){
      if(newStatus === 'Baru'){
        badge.className = 'inline-flex rounded-full bg-red-100 text-red-700 px-2.5 py-1 text-xs';
      } else if(newStatus === 'Dibalas'){
        badge.className = 'inline-flex rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 text-xs';
      } else {
        badge.className = 'inline-flex rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs';
      }
      badge.textContent = newStatus;
    }

    setBadge(newStatus);
    alert('UI saja: perubahan disimpan di tampilan (belum ke database).');
    applyFilter();
  });

  // init
  bindRows();
  applyFilter();

  // auto select first row (biar kanan langsung ada isinya)
  const first = getRows()[0];
  if(first){
    first.classList.add('ring-2','ring-green-200','bg-green-50');
    fillDetail(first);
  }
})();
</script>