<!DOCTYPE html>
<html lang="en">
{{-- set page-specific title (option A: set $title variable) --}}
@php($title = 'Selamat Datang')
@include('Component.Head')

<body>
    {{-- include navbar partial --}}
    @include('LandingPage.Component.Navbar')

    <main class="">
        {{-- include hero partial --}}
        @include('LandingPage.Component.Hero')
        {{-- include about me partial --}}
        @include('LandingPage.Component.AboutMe')
        {{-- include portfolio partial --}}
        @if(($settings['section_portfolio_active'] ?? '1') === '1')
            @include('LandingPage.Component.Portfolio')
        @endif
        {{-- include certificate partial --}}
        @if(($settings['section_certificate_active'] ?? '1') === '1')
            @include('LandingPage.Component.Certificate')
        @endif
        {{-- include cooperation partial --}}
        @if(($settings['section_partner_active'] ?? '1') === '1')
            @include('LandingPage.Component.Cooperation')
        @endif
    </main>

    {{-- include footer partial --}}
    @include('LandingPage.Component.Footer')
</body>

</html>