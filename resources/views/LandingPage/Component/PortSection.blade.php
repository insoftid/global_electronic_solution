<section>
    <div class="max-w-6xl mx-auto px-6 py-10">
        @php
            $projects = [
                [
                    'image' => 'img/porto.png',
                    'title' => 'Automated Production Line',
                    'company' => 'Indofood Manufacturing',
                    'description' => 'Sistem otomatis lini produksi makanan dengan kontrol kualitas terintegrasi dan efisiensi maksimal.',
                    'link' => '/porto/1',
                    'category' => 'AUTOMATION',
                    'tags' => ['Robotics','Quality Control','HMI']
                ],
                [
                    'image' => 'img/porto.png',
                    'title' => 'Industrial Control System',
                    'company' => 'PT. Teknologi Nusantara',
                    'description' => 'Solusi SCADA dan PLC terintegrasi untuk monitoring dan optimasi proses industri.',
                    'link' => '/porto/2',
                    'category' => 'CONTROL',
                    'tags' => ['SCADA','PLC']
                ],
                [
                    'image' => 'img/porto.png',
                    'title' => 'Energy Monitoring Platform',
                    'company' => 'GreenEnergy Co',
                    'description' => 'Platform monitoring energi realtime untuk pengurangan konsumsi dan optimasi biaya.',
                    'link' => '/porto/3',
                    'category' => 'ENERGY',
                    'tags' => ['IoT','Analytics','Dashboard']
                ],
                [
                    'image' => 'img/porto.png',
                    'title' => 'Packaging Optimization',
                    'company' => 'PT. Sukses Pack',
                    'description' => 'Optimasi proses pengepakan dengan vision system untuk menurunkan reject rate.',
                    'link' => '/porto/4',
                    'category' => 'OPTIMIZATION',
                    'tags' => ['Vision','Automation']
                ],
                [
                    'image' => 'img/porto.png',
                    'title' => 'Smart Meter Integration',
                    'company' => 'Kota Energi',
                    'description' => 'Integrasi smart meter untuk analitik konsumsi warga dan penghematan biaya.',
                    'link' => '/porto/5',
                    'category' => 'SMART GRID',
                    'tags' => ['IoT','SmartGrid']
                ],
                [
                    'image' => 'img/porto.png',
                    'title' => 'Packaging Optimization 2',
                    'company' => 'PT. Packaging',
                    'description' => 'Solusi tambahan untuk optimasi proses pengepakan.',
                    'link' => '/porto/6',
                    'category' => 'OPTIMIZATION',
                    'tags' => ['Vision','Automation']
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($projects as $p)
                <div>
                    @include('LandingPage.Component.PortoCard', [
                        'image' => $p['image'],
                        'title' => $p['title'],
                        'company' => $p['company'],
                        'description' => $p['description'],
                        'link' => $p['link'],
                        'category' => $p['category'],
                        'tags' => $p['tags']
                    ])
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-center">
            <a href="/portofolio" class="text-primary font-semibold flex justify-center text-xl mt-5 hover:underline">Lihat Selengkapnya -></a>
        </div>
    </div>
</section>