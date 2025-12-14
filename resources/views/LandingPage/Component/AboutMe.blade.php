{{-- resources/views/LandingPage/Component/AboutMe.blade.php --}}
<div id="tentang" class="max-w-6xl mx-auto py-10 md:py-20">
    <!-- Header: image + about text -->
    <div class="flex flex-col md:flex-row items-center mb-10 gap-10 md:mb-20">
        <div class="text-center order-2 md:order-1">
            <div class="w-[365px] h-[365px] mb-4 rounded-xl overflow-hidden">
                <img src="{{ asset('img/bghero.png') }}" alt="about" class="w-full h-full object-cover" />
            </div>
        </div>

        <div class="mx-4 md:ml-20 order-1 md:order-2">
            <h3 class="text-heading text-center md:text-left">Tentang Kami</h3>
            <p class="text-paragraph mt-3 leading-tight text-center md:text-left">
                CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal.
                Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan sistem elektronika serta
                solusi otomasi yang efisien dan andal.
            </p>
        </div>
    </div>

    <!-- Middle: Visi | img | Misi -->
    <div class="flex flex-col md:flex-row items-start mb-4 px-4 md:px-0 gap-10">
        <div class="w-full md:w-1/3">
            <div class="text-center mb-10">
                <h4 class="text-heading">Visi</h4>
            </div>
            <ul class="list-unstyled list-dot leading-tight">
                <li class="text-paragraph">CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal.</li>
                <li class="text-paragraph">Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan.</li>
                <li class="text-paragraph">Sistem elektronika serta solusi otomasi yang efisien dan andal.</li>
            </ul>
        </div>

        <div class="w-1/3 hidden md:block">
            <div class="w-full overflow-hidden rounded-t-xl">
                <img src="{{ asset('img/bghero.png') }}" alt="work-1" class="w-full h-72 object-cover" />
            </div>
            <div class="w-full overflow-hidden rounded-b-xl">
                <img src="{{ asset('img/bghero.png') }}" alt="work-2" class="w-full h-72 object-cover" />
            </div>
        </div>

        <div class="w-full md:w-1/3">
            <div class="text-center mb-10">
                <h4 class="text-heading">Misi</h4>
            </div>
            <ul class="list-unstyled list-dot leading-tight">
                <li class="text-paragraph">CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal.</li>
                <li class="text-paragraph">Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan.</li>
                <li class="text-paragraph">Sistem elektronika serta solusi otomasi yang efisien dan andal.</li>
            </ul>
        </div>
    </div>

    <!-- Footer: Quality Policy -->
    <div class="mt-10 md:mt-20">
        <div class="text-center">
            <div class="text-center mb-5">
                <h4 class="text-heading">Kebijakan Mutu</h4>
            </div>
            <ul class="list-unstyled list-dot leading-tight d-inline-block text-left">
                <li class="text-paragraph">CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal.</li>
                <li class="text-paragraph">Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan.</li>
                <li class="text-paragraph">Sistem elektronika serta solusi otomasi yang efisien dan andal.</li>
            </ul>
        </div>
    </div>
</div>