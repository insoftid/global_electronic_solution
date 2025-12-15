<!DOCTYPE html>
<html lang="en">
    @php
    $title = 'Dashboard Admin';
    $active = 'dashboard';
    $slot = 5; // dummy variable to avoid blade error
    @endphp

    @include('Component.Head')
<body>
    <section class="flex">
        @include('Admin.Component.Sidebar')
        <main class="flex-1 min-h-screen md:pl-0">
            @include('Admin.Component.Header', ['title' => $title ?? 'Dashboard Admin'])

            <div class="px-5 pt-24 md:pl-72 bg-gray-100 min-h-screen">
                <h1>test</h1>
            </div>
        </main>
    </section>
</body>
</html>