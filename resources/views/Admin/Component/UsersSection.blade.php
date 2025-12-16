@php
  // Dummy data (front-end only)
  $admins = [
    ['id'=>1,'name'=>'Admin Utama','email'=>'admin@ges.co.id','role'=>'Superadmin','status'=>'Aktif'],
    ['id'=>2,'name'=>'Editor Konten','email'=>'editor@ges.co.id','role'=>'Editor','status'=>'Aktif'],
    ['id'=>3,'name'=>'Admin Cadangan','email'=>'backup@ges.co.id','role'=>'Editor','status'=>'Nonaktif'],
  ];
@endphp

<section class="space-y-4">

  {{-- TOP BAR: Search + Filter + Total --}}
  <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
    <div class="flex flex-col sm:flex-row gap-3 w-full">
      <input id="searchInput"
             type="text"
             placeholder="Cari nama atau email..."
             class="w-full sm:w-80 rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />

      <select id="roleFilter"
              class="w-full sm:w-52 rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
        <option value="all">Semua Role</option>
        <option value="Superadmin">Superadmin</option>
        <option value="Editor">Editor</option>
      </select>
    </div>

    <div class="ml-auto inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-2 text-xs text-gray-600">
      <span>Total:</span>
      <span id="totalAdmin" class="font-semibold">{{ count($admins) }}</span>
      <span>admin</span>
    </div>
  </div>

  {{-- GRID: Left Table + Right Form --}}
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

    {{-- LEFT: Table --}}
    <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl p-4">
      <div class="flex items-start justify-between gap-3">
        <div>
          <h3 class="font-bold text-gray-900">Daftar Admin</h3>
          <p class="text-xs text-gray-500 mt-1">Klik baris untuk edit di panel kanan.</p>
        </div>
      </div>

      <div class="mt-3 overflow-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-xs text-gray-500 border-b border-gray-100">
              <th class="py-3 pr-3">Nama</th>
              <th class="py-3 pr-3">Email</th>
              <th class="py-3 pr-3">Role</th>
              <th class="py-3">Status</th>
            </tr>
          </thead>

          <tbody id="adminTableBody">
            @foreach($admins as $a)
            <tr
              class="admin-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
              data-id="{{ $a['id'] }}"
              data-name="{{ $a['name'] }}"
              data-email="{{ $a['email'] }}"
              data-role="{{ $a['role'] }}"
              data-status="{{ $a['status'] }}"
            >
              <td class="py-3 pr-3 font-medium text-gray-900">{{ $a['name'] }}</td>
              <td class="py-3 pr-3 text-gray-600">{{ $a['email'] }}</td>
              <td class="py-3 pr-3">
                <span class="inline-flex items-center rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs">
                  {{ $a['role'] }}
                </span>
              </td>
              <td class="py-3">
                @if($a['status'] === 'Aktif')
                  <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 text-xs">
                    Aktif
                  </span>
                @else
                  <span class="inline-flex items-center rounded-full bg-gray-200 text-gray-700 px-2.5 py-1 text-xs">
                    Nonaktif
                  </span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div id="emptyState" class="hidden text-center py-10 text-sm text-gray-500">
          Data admin tidak ditemukan.
        </div>
      </div>
    </div>

    {{-- RIGHT: Form --}}
    <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl p-4">
      <div>
        <h3 class="font-bold text-gray-900">Tambah / Edit Admin</h3>
        <p class="text-xs text-gray-500 mt-1">Isi data di bawah, lalu klik Simpan. (UI saja)</p>
      </div>

      <form id="adminForm" class="mt-4 space-y-3" onsubmit="return false;">
        <input type="hidden" id="adminId" value="" />

        <div>
          <label class="text-xs text-gray-500">Nama</label>
          <input id="nameInput" type="text"
                 placeholder="Contoh: Budi Santoso"
                 class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        </div>

        <div>
          <label class="text-xs text-gray-500">Email</label>
          <input id="emailInput" type="email"
                 placeholder="contoh@domain.com"
                 class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        </div>

        <div>
          <label class="text-xs text-gray-500">Role</label>
          <select id="roleInput"
                  class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
            <option value="Superadmin">Superadmin</option>
            <option value="Editor">Editor</option>
          </select>
        </div>

        <div>
          <label class="text-xs text-gray-500">Status</label>
          <select id="statusInput"
                  class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
          </select>
        </div>

        <div>
          <label class="text-xs text-gray-500">Password (opsional)</label>
          <input id="passInput" type="password"
                 placeholder="Isi jika ingin set / reset password"
                 class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
        <button type="button" id="resetBtn"
                class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
            Reset
        </button>

        <button type="button" id="deleteBtn"
                class="rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
            Hapus
        </button>

        <button type="button" id="saveBtn"
                class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
            Simpan
        </button>
        </div>

        <p class="text-xs text-gray-500 pt-1">
          *Ini hanya tampilan (dummy). Nanti bisa disambungkan ke backend jika diperlukan.
        </p>
      </form>
    </div>

  </div>
</section>

{{-- UI-only JS (klik row, search, filter) --}}
<script>
  (function () {
    const rows = Array.from(document.querySelectorAll('.admin-row'));
    const searchInput = document.getElementById('searchInput');
    const roleFilter = document.getElementById('roleFilter');
    const totalAdmin = document.getElementById('totalAdmin');
    const emptyState = document.getElementById('emptyState');

    // Form fields
    const adminId = document.getElementById('adminId');
    const nameInput = document.getElementById('nameInput');
    const emailInput = document.getElementById('emailInput');
    const roleInput = document.getElementById('roleInput');
    const statusInput = document.getElementById('statusInput');
    const passInput = document.getElementById('passInput');
    const resetBtn = document.getElementById('resetBtn');
    const saveBtn = document.getElementById('saveBtn');

    function clearActive() {
      rows.forEach(r => r.classList.remove('ring-2','ring-green-200','bg-green-50'));
    }

    function fillFormFromRow(row) {
      adminId.value = row.dataset.id || '';
      nameInput.value = row.dataset.name || '';
      emailInput.value = row.dataset.email || '';
      roleInput.value = row.dataset.role || 'Editor';
      statusInput.value = row.dataset.status || 'Aktif';
      passInput.value = '';
    }

    rows.forEach(row => {
      row.addEventListener('click', () => {
        clearActive();
        row.classList.add('ring-2','ring-green-200','bg-green-50');
        fillFormFromRow(row);
      });
    });

    resetBtn.addEventListener('click', () => {
      clearActive();
      adminId.value = '';
      nameInput.value = '';
      emailInput.value = '';
      roleInput.value = 'Superadmin';
      statusInput.value = 'Aktif';
      passInput.value = '';
      searchInput.value = '';
      roleFilter.value = 'all';
      applyFilter();
    });

    saveBtn.addEventListener('click', () => {
      // UI-only (dummy)
      alert('UI saja: data belum tersimpan ke database/backend.');
    });

    function applyFilter() {
      const q = (searchInput.value || '').toLowerCase().trim();
      const role = roleFilter.value;

      let visibleCount = 0;

      rows.forEach(row => {
        const name = (row.dataset.name || '').toLowerCase();
        const email = (row.dataset.email || '').toLowerCase();
        const rowRole = row.dataset.role || '';

        const matchText = !q || name.includes(q) || email.includes(q);
        const matchRole = (role === 'all') || (rowRole === role);

        const show = matchText && matchRole;
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });

      totalAdmin.textContent = visibleCount;
      emptyState.classList.toggle('hidden', visibleCount !== 0);
    }

    searchInput.addEventListener('input', applyFilter);
    roleFilter.addEventListener('change', applyFilter);

    // Init
    applyFilter();
  })();
</script>