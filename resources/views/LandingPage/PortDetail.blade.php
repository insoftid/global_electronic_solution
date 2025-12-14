<!DOCTYPE html>
<html lang="en">
<head>
    @php($title = 'Contact')
    @include('Component.Head')
</head>
<body>
    @include('LandingPage.Component.Navbar')

    <main>
        @include('LandingPage.Component.PortDetailHero')

        @include('LandingPage.Component.PortDetailSection')

        @include('LandingPage.Component.PortDetailGallery')

        @include('LandingPage.Component.CTASection')
    </main>

    @include('LandingPage.Component.Footer')
</body>
</html>