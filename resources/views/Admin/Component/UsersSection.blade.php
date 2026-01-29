<section class="space-y-4">

  {{-- TOP BAR: Search + Filter + Total --}}
  <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
    <div class="flex flex-col sm:flex-row gap-3 w-full">
      <input id="searchInput" type="text" placeholder="Cari nama atau email..."
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
      <span id="totalAdmin" class="font-semibold">{{ count($users ?? []) }}</span>
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
            @forelse($users ?? [] as $user)
              <tr class="admin-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                data-role="{{ $user->role }}" data-status="{{ $user->status }}">
                <td class="py-3 pr-3 font-medium text-gray-900">{{ $user->name }}</td>
                <td class="py-3 pr-3 text-gray-600">{{ $user->email }}</td>
                <td class="py-3 pr-3">
                  <span class="inline-flex items-center rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs">
                    {{ $user->role }}
                  </span>
                </td>
                <td class="py-3">
                  @if($user->status === 'Aktif')
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
            @empty
              <tr>
                <td colspan="4" class="py-8 text-center text-gray-500">Belum ada user terdaftar.</td>
              </tr>
            @endforelse
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
        <p class="text-xs text-gray-500 mt-1">Isi data di bawah, lalu klik Simpan.</p>
      </div>

      <form id="adminForm" class="mt-4 space-y-3">
        @csrf
        <input type="hidden" id="adminId" name="id" value="" />
        <input type="hidden" id="formMethod" value="POST" />

        <div>
          <label class="text-xs text-gray-500">Nama <span class="text-red-500">*</span></label>
          <input id="nameInput" name="name" type="text" placeholder="Contoh: Budi Santoso"
            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
        </div>

        <div>
          <label class="text-xs text-gray-500">Email <span class="text-red-500">*</span></label>
          <input id="emailInput" name="email" type="email" placeholder="contoh@domain.com"
            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
          <p class="text-xs text-gray-400 mt-1">Gunakan email yang valid</p>
        </div>

        <div>
          <label class="text-xs text-gray-500">Role</label>
          <select id="roleInput" name="role"
            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
            <option value="Superadmin">Superadmin</option>
            <option value="Editor">Editor</option>
          </select>
        </div>

        <div>
          <label class="text-xs text-gray-500">Status</label>
          <select id="statusInput" name="status"
            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
          </select>
        </div>

        <div>
          <label class="text-xs text-gray-500">Password <span id="passHint" class="text-red-500">(wajib untuk user
              baru)</span></label>
          <input id="passInput" name="password" type="password" placeholder="Minimal 8 karakter"
            class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
          <p class="text-xs text-gray-400 mt-1">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah.</p>
        </div>

        <div id="formMessage" class="hidden text-sm py-2 px-3 rounded-lg"></div>

        <div class="flex items-center justify-end gap-2 pt-2">
          <button type="button" id="resetBtn"
            class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm hover:bg-gray-50">
            Reset
          </button>

          <button type="button" id="deleteBtn"
            class="hidden rounded-full border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700 hover:bg-red-100">
            Hapus
          </button>

          <button type="submit" id="saveBtn"
            class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
            Simpan
          </button>
        </div>
      </form>
    </div>

  </div>
</section>

{{-- AJAX JS for CRUD operations --}}
<script>
  (function () {
    const currentUserRole = "{{ auth()->user()->role }}";
    const rows = () => Array.from(document.querySelectorAll('.admin-row'));
    const searchInput = document.getElementById('searchInput');
    const roleFilter = document.getElementById('roleFilter');
    const totalAdmin = document.getElementById('totalAdmin');
    const emptyState = document.getElementById('emptyState');
    const tableBody = document.getElementById('adminTableBody');

    // Form fields
    const form = document.getElementById('adminForm');
    const adminId = document.getElementById('adminId');
    const formMethod = document.getElementById('formMethod');
    const nameInput = document.getElementById('nameInput');
    const emailInput = document.getElementById('emailInput');
    const roleInput = document.getElementById('roleInput');
    const statusInput = document.getElementById('statusInput');
    const passInput = document.getElementById('passInput');
    const passHint = document.getElementById('passHint');
    const resetBtn = document.getElementById('resetBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const formMessage = document.getElementById('formMessage');

    const csrfToken = document.querySelector('input[name="_token"]').value;

    // API Base URLs - updated to match new routes
    const API_URLS = {
      store: '/admin/users/store',
      update: (id) => `/admin/users/update/${id}`,
      delete: (id) => `/admin/users/delete/${id}`
    };

    function clearActive() {
      rows().forEach(r => r.classList.remove('ring-2', 'ring-green-200', 'bg-green-50'));
    }

    function fillFormFromRow(row) {
      adminId.value = (row.dataset.id || '').trim();
      formMethod.value = 'PUT';
      nameInput.value = row.dataset.name || '';
      emailInput.value = row.dataset.email || '';
      roleInput.value = row.dataset.role || 'Editor';
      statusInput.value = row.dataset.status || 'Aktif';
      passInput.value = '';
      passHint.textContent = '(kosongkan jika tidak ingin mengubah)';

      // Permission Logic for non-Superadmin
      if (currentUserRole !== 'Superadmin') {
        roleInput.disabled = true;
        statusInput.disabled = true;
        passInput.disabled = true;
        passInput.placeholder = "Hanya Superadmin dapat mengubah password";
        deleteBtn.classList.add('hidden');
      } else {
        roleInput.disabled = false;
        statusInput.disabled = false;
        passInput.disabled = false;
        passInput.placeholder = "Minimal 8 karakter";
        deleteBtn.classList.remove('hidden');
      }
    }

    function resetForm() {
      clearActive();
      adminId.value = '';
      formMethod.value = 'POST';
      nameInput.value = '';
      emailInput.value = '';

      if (currentUserRole !== 'Superadmin') {
        roleInput.value = 'Editor';
        roleInput.disabled = true;
        statusInput.value = 'Aktif';
        statusInput.disabled = true;
        passInput.disabled = false;
        passInput.placeholder = "Minimal 8 karakter";
      } else {
        roleInput.value = 'Superadmin';
        roleInput.disabled = false;
        statusInput.value = 'Aktif';
        statusInput.disabled = false;
        passInput.disabled = false;
        passInput.placeholder = "Minimal 8 karakter";
      }

      passInput.value = '';
      passHint.textContent = '(wajib untuk user baru)';
      deleteBtn.classList.add('hidden');
      hideMessage();
    }

    function showMessage(msg, isError = false) {
      formMessage.textContent = msg;
      formMessage.className = 'text-sm py-2 px-3 rounded-lg ' + (isError ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700');
      formMessage.classList.remove('hidden');
    }

    function hideMessage() {
      formMessage.classList.add('hidden');
    }

    // Helper function to make API requests
    async function apiRequest(url, data) {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(data),
      });

      // Get response text first
      const responseText = await response.text();

      // Try to parse as JSON
      let result;
      try {
        result = JSON.parse(responseText);
      } catch (e) {
        console.error('Failed to parse response:', responseText.substring(0, 500));
        throw new Error('Server mengembalikan respons yang tidak valid');
      }

      return { response, result };
    }

    // Format error messages from API response
    function formatErrorMessage(result) {
      if (result.errors) {
        const errorMessages = [];
        for (const field in result.errors) {
          errorMessages.push(...result.errors[field]);
        }
        return result.message + ': ' + errorMessages.join(', ');
      }
      return result.message || 'Terjadi kesalahan';
    }

    // Bind row click events
    function bindRowEvents() {
      rows().forEach(row => {
        row.addEventListener('click', () => {
          clearActive();
          row.classList.add('ring-2', 'ring-green-200', 'bg-green-50');
          fillFormFromRow(row);
        });
      });
    }

    bindRowEvents();
    resetBtn.addEventListener('click', resetForm);

    // Save (Create or Update)
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      hideMessage();

      const id = (adminId.value || '').toString().trim();
      const isUpdate = id !== '' && id !== '0';

      // Determine URL based on operation
      const url = isUpdate ? API_URLS.update(id) : API_URLS.store;

      console.log('Form submission:', { id, isUpdate, url });

      // Build data object
      const data = {
        name: nameInput.value.trim(),
        email: emailInput.value.trim(),
      };

      // Include role/status only if not disabled
      if (!roleInput.disabled) {
        data.role = roleInput.value;
      }
      if (!statusInput.disabled) {
        data.status = statusInput.value;
      }

      // Include password if provided and not disabled
      if (passInput.value && !passInput.disabled) {
        data.password = passInput.value;
      }

      try {
        const { response, result } = await apiRequest(url, data);

        if (response.ok && result.success) {
          showMessage(result.message);
          setTimeout(() => location.reload(), 1000);
        } else {
          const errorMsg = formatErrorMessage(result);
          showMessage(errorMsg, true);
          if (typeof showToast === 'function') {
            showToast({ title: 'Error', message: errorMsg }, 'error');
          }
        }
      } catch (err) {
        console.error('Request error:', err);
        showMessage(err.message || 'Terjadi kesalahan koneksi', true);
        if (typeof showToast === 'function') {
          showToast({ title: 'Error', message: err.message }, 'error');
        }
      }
    });

    // Delete
    deleteBtn.addEventListener('click', async () => {
      const id = (adminId.value || '').toString().trim();
      if (!id) return;
      if (!confirm('Yakin ingin menghapus user ini?')) return;

      try {
        const { response, result } = await apiRequest(API_URLS.delete(id), {});

        if (response.ok && result.success) {
          showMessage(result.message);
          setTimeout(() => location.reload(), 1000);
        } else {
          const errorMsg = formatErrorMessage(result);
          showMessage(errorMsg, true);
          if (typeof showToast === 'function') {
            showToast({ title: 'Error', message: errorMsg }, 'error');
          }
        }
      } catch (err) {
        console.error('Delete error:', err);
        showMessage(err.message || 'Terjadi kesalahan koneksi', true);
        if (typeof showToast === 'function') {
          showToast({ title: 'Error', message: err.message }, 'error');
        }
      }
    });

    // Filter
    function applyFilter() {
      const q = (searchInput.value || '').toLowerCase().trim();
      const role = roleFilter.value;

      let visibleCount = 0;

      rows().forEach(row => {
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