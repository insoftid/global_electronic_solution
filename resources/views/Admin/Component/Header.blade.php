<header class="w-full bg-white border-b border-gray-300 px-4 pb-4 md:pb-4 md:pt-1 flex items-center justify-between md:pl-72">
    <div class="flex items-center gap-3">
        <!-- Sidebar toggle (visible on small screens) -->
        <button id="sidebar-toggle" aria-controls="admin-sidebar" aria-expanded="false" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none" title="Toggle sidebar">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Dynamic title: pass $title from parent or set slot --}}
        @if(isset($title))
            <h1 class="text-2xl font-bold text-black">{{ $title }}</h1>
        @else
            <h1 class="text-2xl font-bold text-black">@yield('title', 'Admin')</h1>
        @endif
    </div>

    @if(isset($active) && $active === 'dashboard')
    <div class="flex items-center gap-3">
        <a href="/admin/contacts" class="bg-gray-200 p-2 rounded-lg">
            <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 17V18H0V17L2 15V9C2 5.9 4.03 3.17 7 2.29V2C7 1.46957 7.21071 0.960859 7.58579 0.585786C7.96086 0.210714 8.46957 0 9 0C9.53043 0 10.0391 0.210714 10.4142 0.585786C10.7893 0.960859 11 1.46957 11 2V2.29C13.97 3.17 16 5.9 16 9V15L18 17ZM11 19C11 19.5304 10.7893 20.0391 10.4142 20.4142C10.0391 20.7893 9.53043 21 9 21C8.46957 21 7.96086 20.7893 7.58579 20.4142C7.21071 20.0391 7 19.5304 7 19" fill="black"/>
            </svg>

            <span class="absolute right-2 top-2 bg-red-500 text-white rounded-full px-2 py-1 text-[10px]">{{ $slot ?? '' }}</span>
        </a>
    </div>
    @endif

    <script>
        (function(){
            const btn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (!btn || !sidebar) return;

            function openSidebar(){
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                if (overlay) overlay.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
            }
            function closeSidebar(){
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                if (overlay) overlay.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            }

            btn.addEventListener('click', function(){
                const expanded = btn.getAttribute('aria-expanded') === 'true';
                if (expanded) closeSidebar(); else openSidebar();
            });

            if (overlay) overlay.addEventListener('click', closeSidebar);

            // ensure sidebar is visible on resize >= md
            window.addEventListener('resize', function(){
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    if (overlay) overlay.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    if (overlay) overlay.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });
        })();
    </script>
</header>
