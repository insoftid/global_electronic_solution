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
        @include('LandingPage.Component.Portfolio')
        {{-- include certificate partial --}}
        <!-- @include('LandingPage.Component.Certificate') -->
        {{-- include cooperation partial --}}
        @include('LandingPage.Component.Cooperation')
    </main>

    {{-- include footer partial --}}
    @include('LandingPage.Component.Footer')
</body>

</html>