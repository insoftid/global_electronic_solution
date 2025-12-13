<!DOCTYPE html>
<html lang="en">
<head>
    @php($title = 'Contact')
    @include('Component.Head')
</head>
<body>
    @include('LandingPage.Component.Navbar')

    <main>
        @include('LandingPage.Component.ContactHero')

        @include('LandingPage.Component.ContactSection')
    </main>

    @include('LandingPage.Component.Footer')
</body>
</html>