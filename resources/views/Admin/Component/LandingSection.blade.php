{{-- data for partials --}}
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

@include('Admin.Component.PortLanSection')

@php
  $certs = [
    ['id'=>1,'name'=>'ISO 9001:2015','file'=>'iso-9001.jpg'],
    ['id'=>2,'name'=>'ISO 14001:2015','file'=>'iso-14001.jpg'],
  ];
@endphp

@include('Admin.Component.SertLanSection')

@php
  $partners = [
    ['id'=>1,'name'=>'IndoFood','file'=>'logo-indofood.png'],
    ['id'=>2,'name'=>'Putra Karya Baja','file'=>'logo-pkb.png'],
    ['id'=>3,'name'=>'BK Foundation','file'=>'logo-bk.png'],
  ];
@endphp

@include('Admin.Component.PartLanSection')

{{-- UI-only JS --}}
<!-- UI scripts moved to component partials (PortLanSection, SertLanSection, PartLanSection) -->

<!-- Landing images modal -->
<div id="image-modal-landing" class="fixed inset-0 z-50 hidden bg-black/70 p-4" aria-hidden="true">
  <div class="flex items-center justify-center w-full h-full">
    <div class="relative max-w-[95%] max-h-[95%]">
      <button id="image-modal-close-landing" class="absolute top-2 right-2 bg-black/40 text-white rounded-full py-1 px-3 hover:bg-black/60">&times;</button>
      <img id="image-modal-img-landing" src="" alt="Full preview" class="w-full h-full object-contain rounded" />
    </div>
  </div>
</div>

<!-- Project multi-file preview and modal logic moved to PortLanSection partial -->