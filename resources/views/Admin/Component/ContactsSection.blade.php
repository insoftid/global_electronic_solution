<section class="space-y-4">

  {{-- TOP BAR --}}
  <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
    <div class="flex flex-col sm:flex-row gap-3 w-full">
      <input id="searchMsg" type="text" placeholder="Cari nama, email, atau subjek..."
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
      <span id="totalMsg" class="font-semibold">{{ $messages->total() ?? 0 }}</span>
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
            @forelse($messages ?? [] as $message)
              <tr class="msg-row cursor-pointer border-b border-gray-50 hover:bg-gray-50 transition"
                data-id="{{ $message->id }}" data-name="{{ $message->name }}" data-email="{{ $message->email }}"
                data-subject="{{ $message->subject ?? 'Tanpa Subjek' }}" data-status="{{ $message->status }}"
                data-date="{{ $message->created_at->format('d M Y') }}" data-content="{{ $message->message }}"
                data-notes="{{ $message->admin_notes }}">
                <td class="py-3 pr-3 font-medium text-gray-900">{{ $message->name }}</td>
                <td class="py-3 pr-3 text-gray-600">{{ $message->email }}</td>
                <td class="py-3 pr-3 text-gray-700">{{ Str::limit($message->subject ?? 'Tanpa Subjek', 30) }}</td>
                <td class="py-3 pr-3">
                  @if($message->status === 'Baru')
                    <span class="inline-flex rounded-full bg-red-100 text-red-700 px-2.5 py-1 text-xs">Baru</span>
                  @elseif($message->status === 'Dibaca')
                    <span class="inline-flex rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs">Dibaca</span>
                  @else
                    <span class="inline-flex rounded-full bg-green-100 text-green-700 px-2.5 py-1 text-xs">Dibalas</span>
                  @endif
                </td>
                <td class="py-3 text-gray-700">{{ $message->created_at->format('d M Y') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="py-8 text-center text-gray-500">Belum ada pesan masuk.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div id="emptyStateMsg" class="hidden text-center py-10 text-sm text-gray-500">
          Pesan tidak ditemukan.
        </div>

        {{-- Pagination --}}
        @if($messages instanceof \Illuminate\Pagination\LengthAwarePaginator && $messages->hasPages())
          <div class="mt-4">
            {{ $messages->links() }}
          </div>
        @endif
      </div>
    </div>

    {{-- RIGHT: DETAIL --}}
    <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl overflow-hidden flex flex-col">
      <div class="border-b border-gray-100 pb-3 px-4 pt-4">
        <h3 id="detailSubject" class="font-bold text-gray-900">Pilih pesan untuk melihat detail</h3>
        <p class="text-xs text-gray-500 mt-1">
          Dari <span id="detailName">-</span> • <span id="detailEmail">-</span>
        </p>
      </div>

      <div class="py-3 px-4 text-sm text-gray-700 space-y-2">
        <div class="flex flex-wrap gap-4">
          <div><span class="text-gray-500 text-xs">Nama:</span> <span id="dName" class="font-medium">-</span></div>
          <div><span class="text-gray-500 text-xs">Email:</span> <span id="dEmail" class="font-medium">-</span></div>
        </div>
        <div class="flex flex-wrap gap-4">
          <div><span class="text-gray-500 text-xs">Tanggal:</span> <span id="dDate" class="font-medium">-</span></div>
          <div><span class="text-gray-500 text-xs">Status:</span> <span id="dStatus" class="font-medium">-</span></div>
        </div>
      </div>

      <div class="border-t border-gray-100 pt-3 px-4 pb-4 flex-1">
        <p class="text-xs text-gray-500 mb-2">Isi Pesan</p>
        <div id="dContent" class="text-sm text-gray-700 leading-relaxed">
          -
        </div>
      </div>

      <input type="hidden" id="selectedMsgId" value="" />

      <div class="border-t border-gray-100 px-4 py-4 flex justify-end gap-2 mt-auto">
        <select id="statusChange" class="rounded-lg border border-gray-200 px-3 py-2 text-sm">
          <option value="Baru">Baru</option>
          <option value="Dibaca">Dibaca</option>
          <option value="Dibalas">Dibalas</option>
        </select>
        <button id="updateStatusBtn" type="button"
          class="rounded-full bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
          Update Status
        </button>
        <button id="deleteBtn" type="button"
          class="rounded-full bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600">
          Hapus
        </button>
      </div>
    </div>

  </div>
</section>

{{-- AJAX JS --}}
{{-- Toast Container --}}
<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

<script>
  (function () {
    const rows = () => Array.from(document.querySelectorAll('.msg-row'));
    const searchInput = document.getElementById('searchMsg');
    const statusFilter = document.getElementById('statusFilter');
    const totalMsg = document.getElementById('totalMsg');
    const emptyState = document.getElementById('emptyStateMsg');

    // Detail elements
    const detailSubject = document.getElementById('detailSubject');
    const detailName = document.getElementById('detailName');
    const detailEmail = document.getElementById('detailEmail');
    const dName = document.getElementById('dName');
    const dEmail = document.getElementById('dEmail');
    const dDate = document.getElementById('dDate');
    const dStatus = document.getElementById('dStatus');
    const dContent = document.getElementById('dContent');
    const selectedMsgId = document.getElementById('selectedMsgId');
    const statusChange = document.getElementById('statusChange');
    const updateStatusBtn = document.getElementById('updateStatusBtn');
    const deleteBtn = document.getElementById('deleteBtn');

    const csrfToken = '{{ csrf_token() }}';

    // Toast notification system
    function showToast(message, type = 'success', duration = 4000) {
      const container = document.getElementById('toast-container');
      if (!container) return;
      const toast = document.createElement('div');

      const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
      const icon = type === 'success'
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
        : type === 'error'
          ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
          : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';

      toast.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-3 transform translate-x-full transition-transform duration-300 max-w-sm`;
      toast.innerHTML = `
          <span class="flex-shrink-0">${icon}</span>
          <span class="flex-1 text-sm font-medium">${message}</span>
          <button class="flex-shrink-0 hover:opacity-80" onclick="this.parentElement.remove()">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>
      `;

      container.appendChild(toast);

      requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full');
        toast.classList.add('translate-x-0');
      });

      setTimeout(() => {
        toast.classList.remove('translate-x-0');
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
      }, duration);

      return toast;
    }

    function clearActive() {
      rows().forEach(r => r.classList.remove('ring-2', 'ring-green-200', 'bg-green-50'));
    }

    function showDetail(row) {
      selectedMsgId.value = row.dataset.id;
      detailSubject.textContent = row.dataset.subject || 'Tanpa Subjek';
      detailName.textContent = row.dataset.name;
      detailEmail.textContent = row.dataset.email;
      dName.textContent = row.dataset.name;
      dEmail.textContent = row.dataset.email;
      dDate.textContent = row.dataset.date;
      dStatus.textContent = row.dataset.status;
      dContent.textContent = row.dataset.content;
      statusChange.value = row.dataset.status;
    }

    rows().forEach(row => {
      row.addEventListener('click', () => {
        clearActive();
        row.classList.add('ring-2', 'ring-green-200', 'bg-green-50');
        showDetail(row);
      });
    });

    // Update status
    updateStatusBtn.addEventListener('click', async () => {
      const id = selectedMsgId.value;
      if (!id) {
        showToast('Pilih pesan terlebih dahulu', 'error');
        return;
      }

      try {
        const response = await fetch(`/admin/contacts/${id}/status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: JSON.stringify({ status: statusChange.value }),
        });

        const result = await response.json();
        if (response.ok && result.success) {
          showToast(result.message || 'Status berhasil diperbarui', 'success');
          // Update row status in table without reload
          const row = document.querySelector(`.msg-row[data-id="${id}"]`);
          if (row) {
            row.dataset.status = statusChange.value;
            dStatus.textContent = statusChange.value;
            // Update badge color
            const badge = row.querySelector('td:nth-child(4) span');
            if (badge) {
              badge.className = statusChange.value === 'Baru'
                ? 'inline-flex rounded-full bg-red-100 text-red-700 px-2.5 py-1 text-xs'
                : statusChange.value === 'Dibaca'
                  ? 'inline-flex rounded-full bg-sky-100 text-sky-700 px-2.5 py-1 text-xs'
                  : 'inline-flex rounded-full bg-green-100 text-green-700 px-2.5 py-1 text-xs';
              badge.textContent = statusChange.value;
            }
          }
        } else {
          showToast(result.message || 'Gagal update status', 'error');
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi', 'error');
      }
    });

    // Delete
    deleteBtn.addEventListener('click', async () => {
      const id = selectedMsgId.value;
      if (!id) {
        showToast('Pilih pesan terlebih dahulu', 'error');
        return;
      }
      if (!confirm('Yakin ingin menghapus pesan ini?')) return;

      try {
        const response = await fetch(`/admin/contacts/${id}`, {
          method: 'DELETE',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
          },
        });

        const result = await response.json();
        if (response.ok && result.success) {
          showToast(result.message || 'Pesan berhasil dihapus', 'success');
          // Remove row from table
          const row = document.querySelector(`.msg-row[data-id="${id}"]`);
          if (row) {
            row.remove();
            // Reset detail panel
            selectedMsgId.value = '';
            detailSubject.textContent = 'Pilih pesan untuk melihat detail';
            detailName.textContent = '-';
            detailEmail.textContent = '-';
            dName.textContent = '-';
            dEmail.textContent = '-';
            dDate.textContent = '-';
            dStatus.textContent = '-';
            dContent.textContent = '-';
            // Update total count
            totalMsg.textContent = parseInt(totalMsg.textContent) - 1;
          }
        } else {
          showToast(result.message || 'Gagal menghapus', 'error');
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi', 'error');
      }
    });

    // Filter
    function applyFilter() {
      const q = (searchInput.value || '').toLowerCase().trim();
      const status = statusFilter.value;

      let visibleCount = 0;

      rows().forEach(row => {
        const name = (row.dataset.name || '').toLowerCase();
        const email = (row.dataset.email || '').toLowerCase();
        const subject = (row.dataset.subject || '').toLowerCase();
        const rowStatus = row.dataset.status || '';

        const matchText = !q || name.includes(q) || email.includes(q) || subject.includes(q);
        const matchStatus = (status === 'all') || (rowStatus === status);

        const show = matchText && matchStatus;
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });

      totalMsg.textContent = visibleCount;
      emptyState.classList.toggle('hidden', visibleCount !== 0);
    }

    searchInput.addEventListener('input', applyFilter);
    statusFilter.addEventListener('change', applyFilter);

    applyFilter();
  })();
</script>