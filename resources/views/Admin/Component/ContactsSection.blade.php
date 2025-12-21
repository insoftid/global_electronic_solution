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
      if (!id) { alert('Pilih pesan terlebih dahulu'); return; }

      try {
        const response = await fetch(`/admin/contacts/${id}/status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify({ status: statusChange.value }),
        });

        const result = await response.json();
        if (response.ok && result.success) {
          alert(result.message);
          location.reload();
        } else {
          alert(result.message || 'Gagal update status');
        }
      } catch (err) {
        alert('Terjadi kesalahan koneksi');
      }
    });

    // Delete
    deleteBtn.addEventListener('click', async () => {
      const id = selectedMsgId.value;
      if (!id) { alert('Pilih pesan terlebih dahulu'); return; }
      if (!confirm('Yakin ingin menghapus pesan ini?')) return;

      try {
        const response = await fetch(`/admin/contacts/${id}`, {
          method: 'DELETE',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
        });

        const result = await response.json();
        if (response.ok && result.success) {
          alert(result.message);
          location.reload();
        } else {
          alert(result.message || 'Gagal menghapus');
        }
      } catch (err) {
        alert('Terjadi kesalahan koneksi');
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