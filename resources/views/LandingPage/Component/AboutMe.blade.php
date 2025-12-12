{{-- resources/views/LandingPage/Component/AboutMe.blade.php --}}
<div class="max-w-6xl mx-auto my-20">
    <style>
        .text-heading {
            font-size: 40px;
            font-weight: 700;
            color: var(--color-primary);
        }
        .text-paragraph {
            font-size: 25px;
            font-weight: 400;
            color: var(--color-graytext);
        }
        /* list with separated bullets and hanging indent */
        .list-dot {
            list-style: none;
            padding-left: 1.25rem; /* space for custom marker */
            margin: 0;
        }
        .list-dot li {
            position: relative;
            padding-left: 1.25rem; /* space between marker and text */
            margin-bottom: .5rem;
        }
        .list-dot li::before {
            content: '•';
            position: absolute;
            left: 0;
            top: 0.25rem;
            color: var(--color-primary);
            font-size: 1.1em;
            line-height: 1;
        }
    </style>
    <!-- Header: image + about text -->
    <div class="flex items-center mb-20">
        <div class="text-center mb-3 mb-md-0">
            <div class="w-[365px] h-[365px] mb-4 rounded-xl overflow-hidden">
                <img src="{{ asset('img/bghero.png') }}" alt="about" class="w-full h-full object-cover" />
            </div>
        </div>

        <div class="ml-20">
            <h3 class="text-heading">Tentang Kami</h3>
            <p class="text-paragraph mt-3 leading-tight">
                CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal.
                Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan sistem elektronika serta
                solusi otomasi yang efisien dan andal.
            </p>
        </div>
    </div>

    <!-- Middle: Visi | img | Misi -->
    <div class="flex items-start mb-4">
        <div class="w-1/3">
            <div class="text-center mb-10">
                <h4 class="text-heading">Visi</h4>
            </div>
            <ul class="list-unstyled list-dot leading-tight">
                <li class="text-paragraph">CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal.</li>
                <li class="text-paragraph">Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan.</li>
                <li class="text-paragraph">Sistem elektronika serta solusi otomasi yang efisien dan andal.</li>
            </ul>
        </div>

        <div class="mx-10 w-1/3">
            <div class="w-full overflow-hidden rounded-md">
                <img src="{{ asset('img/bghero.png') }}" alt="work-1" class="w-full h-72 object-cover" />
            </div>
            <div class="w-full overflow-hidden rounded-md">
                <img src="{{ asset('img/bghero.png') }}" alt="work-2" class="w-full h-72 object-cover" />
            </div>
        </div>

        <div class="w-1/3">
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
    <div class="mt-20">
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