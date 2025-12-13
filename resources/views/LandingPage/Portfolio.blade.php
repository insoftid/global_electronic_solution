<!DOCTYPE html>
<html lang="en">
<head>
    @php($title = 'Portfolio')
    @include('Component.Head')
</head>
<body>
    @include('LandingPage.Component.Navbar')

    <main>
        @include('LandingPage.Component.PortHero')

        @include('LandingPage.Component.PortSection')
    </main>

    @include('LandingPage.Component.Footer')
</body>
</html>