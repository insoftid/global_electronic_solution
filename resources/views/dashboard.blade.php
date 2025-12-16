<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @php($title = 'Dashboard')
    @include('Component.Head')
<body class="min-h-screen bg-gray-50">
    <style>
        :root {
            --ges-primary: #1F7654;
            --ges-secondary: #16A34A;
        }
    </style>

    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 bg-primary rounded-lg shadow-sm">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
                            </svg>
                        </span>
                        <span class="text-primary font-bold text-lg hidden sm:block">Global Electronic Solution</span>
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 text-sm">
                        Selamat datang, <strong class="text-primary">{{ Auth::user()->name ?? 'User' }}</strong>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-xl">
            <h1 class="text-3xl font-bold mb-2">Dashboard</h1>
            <p class="text-white/80">Selamat datang di panel administrasi CV. Global Electronic Solution</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-graytext">Total Portfolio</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                    </div>
                    <div class="p-3 bg-primary/10 rounded-lg">
                        <svg class="w-6 h-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-graytext">Sertifikat</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">8</p>
                    </div>
                    <div class="p-3 bg-secondary/10 rounded-lg">
                        <svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-graytext">Pesan Masuk</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">24</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="flex flex-col items-center p-4 rounded-lg border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-colors group">
                    <svg class="w-8 h-8 text-graytext group-hover:text-primary transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="mt-2 text-sm font-medium text-gray-700 group-hover:text-primary">Tambah Portfolio</span>
                </a>
                <a href="#" class="flex flex-col items-center p-4 rounded-lg border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-colors group">
                    <svg class="w-8 h-8 text-graytext group-hover:text-primary transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="mt-2 text-sm font-medium text-gray-700 group-hover:text-primary">Kelola Konten</span>
                </a>
                <a href="#" class="flex flex-col items-center p-4 rounded-lg border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-colors group">
                    <svg class="w-8 h-8 text-graytext group-hover:text-primary transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="mt-2 text-sm font-medium text-gray-700 group-hover:text-primary">Pengaturan Profil</span>
                </a>
                <a href="/" class="flex flex-col items-center p-4 rounded-lg border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-colors group">
                    <svg class="w-8 h-8 text-graytext group-hover:text-primary transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span class="mt-2 text-sm font-medium text-gray-700 group-hover:text-primary">Lihat Website</span>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-100 mt-10">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-graytext">
                &copy; {{ date('Y') }} CV. Global Electronic Solution. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>
</body>
</html>
