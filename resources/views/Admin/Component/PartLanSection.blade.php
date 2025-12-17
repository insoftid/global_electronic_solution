{{-- PARTNER / KERJASAMA (partial) --}}
@php
  /* $partners should be provided by the parent view */
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
          <div id="partnerFilePreview" class="h-24 w-full bg-gray-50 rounded-md overflow-hidden mb-3 flex items-center justify-center text-gray-400 preview-area">
            <span class="preview-placeholder">Preview Logo</span>
          </div>
          <label for="partnerFile" class="my-2 w-full h-9 rounded-lg border border-gray-300 inline-flex justify-between items-center cursor-pointer pl-3">
            <span class="text-gray-900/60 text-sm font-normal leading-snug truncate file-name" id="partnerFileName">Belum ada file dipilih</span>
            <input id="partnerFile" type="file" accept="image/*" class="hidden file-input" />
            <span class="flex w-28 h-9 px-2 flex-col bg-secondary rounded-r-lg shadow text-white text-xs font-semibold leading-4 items-center justify-center">Choose File</span>
          </label>
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

<script>
(function(){
  function setActive(rows, row){ rows.forEach(r => r.classList.remove('ring-2','ring-green-200','bg-green-50')); if(row) row.classList.add('ring-2','ring-green-200','bg-green-50'); }
  function applySearch(rows, query, emptyEl, matcher){ const q = (query || '').toLowerCase().trim(); let visible = 0; rows.forEach(row => { const text = matcher(row).toLowerCase(); const show = !q || text.includes(q); row.style.display = show ? '' : 'none'; if(show) visible++; }); if(emptyEl) emptyEl.classList.toggle('hidden', visible !== 0); }

  (function(){
    const rows = Array.from(document.querySelectorAll('.partner-row'));
    const search = document.getElementById('partnerSearch');
    const empty  = document.getElementById('partnerEmpty');

    const idEl   = document.getElementById('partnerId');
    const nameEl = document.getElementById('partnerName');
    const fileEl = document.getElementById('partnerFile');
    const infoEl = document.getElementById('partnerFileInfo');
    const partnerPreview = document.getElementById('partnerFilePreview');
    const partnerFileName = document.getElementById('partnerFileName');

    const btnReset  = document.getElementById('partnerReset');
    const btnDelete = document.getElementById('partnerDelete');
    const btnSave   = document.getElementById('partnerSave');

    function fill(row){
      idEl.value = row.dataset.id || '';
      nameEl.value = row.dataset.name || '';
      if(fileEl) fileEl.value = '';
      infoEl.textContent = row.dataset.file ? `File saat ini: ${row.dataset.file}` : 'Belum ada file dipilih.';
      if(partnerPreview){ partnerPreview.innerHTML = ''; if(row.dataset.file){ var img = document.createElement('img'); img.src = row.dataset.file; img.alt = row.dataset.name || 'Logo'; img.className = 'w-full h-full object-contain'; img.style.cursor = 'zoom-in'; img.addEventListener('click', function(){ var modal = document.getElementById('image-modal-landing'); var modalImg = document.getElementById('image-modal-img-landing'); if(modal && modalImg){ modalImg.src = this.src; modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; modal.setAttribute('aria-hidden','false'); } }); partnerPreview.appendChild(img); if(partnerFileName) partnerFileName.textContent = row.dataset.file; } else { partnerPreview.innerHTML = '<span class="preview-placeholder">Preview Logo</span>'; if(partnerFileName) partnerFileName.textContent = 'Belum ada file dipilih'; } }
    }

    rows.forEach(row => { row.addEventListener('click', () => { setActive(rows, row); fill(row); }); });

    if(search) search.addEventListener('input', () => { applySearch(rows, search.value, empty, r => r.dataset.name || ''); });

    if(btnReset) btnReset.addEventListener('click', () => {
      setActive(rows, null);
      if(idEl) idEl.value = '';
      if(nameEl) nameEl.value = '';

      // clear partner file input + preview + labels
      try{
        if(fileEl) fileEl.value = '';
        if(partnerPreview){
          const prev = partnerPreview.getAttribute('data-object-url');
          if(prev){ try{ URL.revokeObjectURL(prev); }catch(e){} partnerPreview.removeAttribute('data-object-url'); }
          partnerPreview.innerHTML = '<span class="preview-placeholder">Preview Logo</span>';
        }
        if(infoEl) infoEl.textContent = 'Belum ada file dipilih.';
        if(partnerFileName) partnerFileName.textContent = 'Belum ada file dipilih';
      }catch(e){ /* ignore */ }

      if(search) search.value = '';
      applySearch(rows, '', empty, r => r.dataset.name || '');
    });

    if(btnSave) btnSave.addEventListener('click', () => { alert('UI saja: Simpan partner belum terhubung ke database.'); });

    if(btnDelete) btnDelete.addEventListener('click', () => { if(!idEl || !idEl.value){ alert('Pilih partner dulu dari tabel sebelum menghapus.'); return; } const row = document.querySelector(`.partner-row[data-id="${idEl.value}"]`); if(row) row.remove(); if(btnReset) btnReset.click(); alert('UI saja: partner dihapus dari tampilan.'); });

    if(rows[0]){ setActive(rows, rows[0]); fill(rows[0]); }

    // Partner file input preview behavior
    if(fileEl){
      fileEl.addEventListener('change', function(){
        var f = this.files && this.files[0];
        if(!partnerPreview) return;
        var prev = partnerPreview.getAttribute('data-object-url');
        if(prev){ try{ URL.revokeObjectURL(prev); }catch(e){} partnerPreview.removeAttribute('data-object-url'); }
        if(f){
          var url = URL.createObjectURL(f);
          partnerPreview.innerHTML = '';
          var img = document.createElement('img');
          img.src = url; img.alt = f.name || 'Preview'; img.className = 'w-full h-full object-contain'; img.style.cursor = 'zoom-in';
          img.addEventListener('click', function(){ var modal = document.getElementById('image-modal-landing'); var modalImg = document.getElementById('image-modal-img-landing'); if(modal && modalImg){ modalImg.src = this.src; modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; modal.setAttribute('aria-hidden','false'); } });
          partnerPreview.appendChild(img);
          partnerPreview.setAttribute('data-object-url', url);
          if(infoEl) infoEl.textContent = f.name;
          if(partnerFileName) partnerFileName.textContent = f.name;
        } else {
          partnerPreview.innerHTML = '<span class="preview-placeholder">Preview Logo</span>';
          if(infoEl) infoEl.textContent = 'Belum ada file dipilih.';
          if(partnerFileName) partnerFileName.textContent = 'Belum ada file dipilih';
        }
      });
    }

  })();

})();
</script>

