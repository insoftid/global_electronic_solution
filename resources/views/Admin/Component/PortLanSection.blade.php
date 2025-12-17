{{-- PROYEK / PORTFOLIO (partial) --}}
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
        <label class="text-xs text-gray-500">Link ke halaman produk lengkap</label>
        <input type="text" value="/produk"
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
              <div class="text-xs text-gray-500">Upload Foto</div>
              <div class="h-24 bg-gray-50 rounded-md overflow-hidden mb-3 flex flex-wrap items-start gap-2 p-2 text-gray-400 preview-area">
                <span class="preview-placeholder flex justify-center items-center w-full h-full">Preview Foto</span>
              </div>
              <label for="photos_logo" class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
                <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name">No files chosen</span>
                <input id="photos_logo" type="file" name="photos[logo][]" accept="image/*" multiple class="hidden file-input" />
                <span class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose Files</span>
              </label>
              <p class="text-[10px] text-graytext" id="favicon_input_help">PNG or JPG (Max 5 MB).</p>
          </div>

          <div>
            <label class="text-xs text-gray-500">link Youtube (opsional)</label>
            <input id="youtubeInput" type="text"
                   placeholder="https://www.youtube.com/watch?v=example"
                   class="mt-1 w-full rounded-xl border border-gray-200 px-4 py-2.5 outline-none focus:ring-2 focus:ring-green-200" />
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

<script>
(function(){
  /* helpers (scoped to this partial) */
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

  /* PROJECT / PORTFOLIO script (scoped) */
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
      if(imgEl) imgEl.value = '';
    }

    rows.forEach(row => {
      row.addEventListener('click', () => {
        setActive(rows, row);
        fill(row);
      });
    });

    if(search) search.addEventListener('input', () => {
      applySearch(rows, search.value, empty,
        r => (r.dataset.title || '') + ' ' + (r.dataset.subtitle || '')
      );
    });

    if(btnReset) btnReset.addEventListener('click', () => {
      setActive(rows, null);
      if(idEl) idEl.value = '';
      if(titleEl) titleEl.value = '';
      if(subEl) subEl.value = '';
      if(detEl) detEl.value = '';
      if(imgEl) imgEl.value = '';

      // reset project photos input + preview
      try{
        const photosInput = document.getElementById('photos_logo');
        const preview = document.querySelector('#projectForm .preview-area') || document.querySelector('.preview-area');
        if(photosInput) photosInput.value = '';
        if(preview){
          const prev = preview.getAttribute('data-object-urls');
          if(prev){ try{ JSON.parse(prev).forEach(u => URL.revokeObjectURL(u)); }catch(e){} preview.removeAttribute('data-object-urls'); }
          preview.innerHTML = '<span class="preview-placeholder flex justify-center items-center w-full h-full">Preview Foto</span>';
        }
        if(photosInput){ const label = photosInput.closest('label'); if(label){ const fn = label.querySelector('.file-name'); if(fn) fn.textContent = 'No files chosen'; } }
      }catch(e){ /* ignore */ }

      // reset youtube input
      const y = document.getElementById('youtubeInput'); if(y) y.value = '';

      if(search) search.value = '';
      applySearch(rows, '', empty, r => r.dataset.title || '');
    });

    if(btnSave) btnSave.addEventListener('click', () => {
      alert('UI saja: Simpan proyek belum terhubung ke database.');
    });

    if(btnDelete) btnDelete.addEventListener('click', () => {
      if(!idEl || !idEl.value){
        alert('Pilih proyek dulu dari tabel sebelum menghapus.');
        return;
      }
      const row = document.querySelector(`.project-row[data-id="${idEl.value}"]`);
      if(row) row.remove();
      if(btnReset) btnReset.click();
      alert('UI saja: proyek dihapus dari tampilan.');
    });

    if(rows[0]){ setActive(rows, rows[0]); fill(rows[0]); }
  })();

  /* Project multi-file preview + modal (scoped)
     This code expects the shared modal HTML (id=image-modal-landing)
     to be present in the parent view. */
  (function(){
    var input = document.getElementById('photos_logo');
    var fileNameSpan = input ? input.closest('label')?.querySelector('.file-name') : null;
    var previewArea = document.querySelector('#projectForm .preview-area') || document.querySelector('.preview-area');

    // NOTE: LandingSection includes the modal HTML after this partial. To avoid
    // timing issues (script running before the modal exists) we look up modal
    // elements lazily inside the open/close functions and attach document-level
    // listeners for close actions.

    var currentFiles = []; // Array<File>

    function openModal(src, alt){
      if(!src) return;
      var modal = document.getElementById('image-modal-landing');
      var modalImg = document.getElementById('image-modal-img-landing');
      if(modalImg) { modalImg.src = src; modalImg.alt = alt || ''; }
      if(modal){ modal.classList.remove('hidden'); modal.setAttribute('aria-hidden','false'); }
      document.body.style.overflow = 'hidden';
    }

    function closeModal(){
      var modal = document.getElementById('image-modal-landing');
      var modalImg = document.getElementById('image-modal-img-landing');
      if(modal) modal.classList.add('hidden');
      if(modalImg) modalImg.src = '';
      if(modal) modal.setAttribute('aria-hidden','true');
      document.body.style.overflow = '';
    }

    // document-level close handlers (works even if modal is added later)
    document.addEventListener('click', function(e){
      if(!e.target) return;
      if(e.target.id === 'image-modal-close-landing') return closeModal();
      if(e.target.id === 'image-modal-landing') return closeModal();
    });

    document.addEventListener('keydown', function(e){
      if(e.key === 'Escape'){
        var modal = document.getElementById('image-modal-landing');
        if(modal && !modal.classList.contains('hidden')) closeModal();
      }
    });

    function revokePreviousUrls(area){
      if(!area) return;
      var prev = area.getAttribute('data-object-urls');
      if(prev){
        try{ JSON.parse(prev).forEach(function(u){ URL.revokeObjectURL(u); }); }catch(e){}
        area.removeAttribute('data-object-urls');
      }
    }

    function renderPreviews(){
      if(!previewArea) return;
      revokePreviousUrls(previewArea);
      previewArea.innerHTML = '';
      if(currentFiles.length === 0){
        previewArea.innerHTML = '<span class="preview-placeholder flex justify-center items-center w-full h-full">Preview Foto</span>';
        if(fileNameSpan) fileNameSpan.textContent = 'No files chosen';
        return;
      }
      var urls = [];
      currentFiles.forEach(function(file, idx){
        var url = URL.createObjectURL(file);
        urls.push(url);
        var wrapper = document.createElement('div');
        wrapper.className = 'relative w-20 h-20 overflow-hidden rounded bg-white flex items-center justify-center border border-gray-100';
        var img = document.createElement('img');
        img.src = url; img.alt = file.name || 'Preview'; img.className = 'w-full h-full object-cover';
        var del = document.createElement('button');
        del.type = 'button';
        del.className = 'absolute top-1 right-1 bg-white/80 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-lg';
        del.innerHTML = '&times;';
        del.addEventListener('click', function(e){
          e.stopPropagation();
          currentFiles.splice(idx, 1);
          try{ URL.revokeObjectURL(url); }catch(ex){}
          var dt = new DataTransfer();
          currentFiles.forEach(function(f){ dt.items.add(f); });
          if(input) input.files = dt.files;
          renderPreviews();
          if(fileNameSpan){
            if(currentFiles.length === 0) fileNameSpan.textContent = 'No files chosen';
            else if(currentFiles.length === 1) fileNameSpan.textContent = currentFiles[0].name;
            else fileNameSpan.textContent = currentFiles.length + ' files selected';
          }
        });
        img.addEventListener('click', function(){ openModal(this.src, this.alt); });
        wrapper.appendChild(img); wrapper.appendChild(del); previewArea.appendChild(wrapper);
      });
      previewArea.setAttribute('data-object-urls', JSON.stringify(urls));
    }

    if(input){
      input.addEventListener('change', function(){
        currentFiles = Array.from(this.files || []);
        if(fileNameSpan){
          if(currentFiles.length === 0) fileNameSpan.textContent = 'No files chosen';
          else if(currentFiles.length === 1) fileNameSpan.textContent = currentFiles[0].name;
          else fileNameSpan.textContent = currentFiles.length + ' files selected';
        }
        renderPreviews();
      });
    }

    // make existing previews clickable on load
    (function(){ if(!previewArea) return; previewArea.querySelectorAll('img').forEach(function(img){ img.style.cursor='zoom-in'; if(!img.dataset.handler){ img.addEventListener('click', function(){ openModal(this.src, this.alt); }); img.dataset.handler='1'; } }); })();
  })();

})();
</script>
