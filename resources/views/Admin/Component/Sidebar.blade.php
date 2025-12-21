<aside id="admin-sidebar" style="position:fixed !important; top:0; left:0; height:100vh; z-index:80;"
	class="w-64 min-h-screen bg-secondary text-white flex flex-col fixed top-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-40"
	aria-label="Primary">
	<!-- Brand / Header -->
	<header class="px-4 py-4 border-b border-gray-300">
		<a href="/admin" class="flex items-center gap-3">
			<img src="{{ asset('img/logo_cv_ges.png') }}" alt="logo CV GES"
				class="w-10 h-10 bg-white rounded-md object-contain p-1" />
			<span class="font-semibold">Admin Panel</span>
		</a>
	</header>

	<!-- Navigation -->
	<nav class="flex-1 overflow-y-auto" aria-label="Main navigation">
		<ul class="py-4 space-y-1">
			<li>
				@if(isset($active) && $active === 'dashboard')
					<a href="/admin" aria-current="page"
						class="flex items-center px-4 py-3 bg-[#12773a] text-white border-l-4 border-white">
				@else
						<a href="/admin" class="flex items-center px-4 py-3 hover:bg-[#12773a]/80">
					@endif
						<span class="ml-1 text-sm">Dashboard</span>
					</a>
			</li>

			<li>
				@if(isset($active) && $active === 'pengaturan')
					<a href="/admin/settings" aria-current="page"
						class="flex items-center px-4 py-3 bg-[#12773a] text-white border-l-4 border-white">
				@else
						<a href="/admin/settings" class="flex items-center px-4 py-3 hover:bg-[#12773a]/80">
					@endif
						<span class="ml-1 text-sm">Tentang Perusahaan</span>
					</a>
			</li>

			<li>
				@if(isset($active) && $active === 'landing')
					<a href="/admin/landing-page" aria-current="page"
						class="flex items-center px-4 py-3 bg-[#12773a] text-white border-l-4 border-white">
				@else
						<a href="/admin/landing-page" class="flex items-center px-4 py-3 hover:bg-[#12773a]/80">
					@endif
						<span class="ml-1 text-sm">Landing Page</span>
					</a>
			</li>

			<li>
				@if(isset($active) && $active === 'kontak')
					<a href="/admin/contacts" aria-current="page"
						class="flex items-center px-4 py-3 bg-[#12773a] text-white border-l-4 border-white">
				@else
						<a href="/admin/contacts" class="flex items-center px-4 py-3 hover:bg-[#12773a]/80">
					@endif
						<span class="ml-1 text-sm">Kontak Masuk</span>
					</a>
			</li>

			@if(auth()->user() && auth()->user()->isSuperadmin())
				<li>
					@if(isset($active) && $active === 'adminakses')
						<a href="/admin/users" aria-current="page"
							class="flex items-center px-4 py-3 bg-[#12773a] text-white border-l-4 border-white">
					@else
							<a href="/admin/users" class="flex items-center px-4 py-3 hover:bg-[#12773a]/80">
						@endif
							<span class="ml-1 text-sm">Admin & Akses</span>
						</a>
				</li>
			@endif
		</ul>
	</nav>

	<!-- User / Footer -->
	<footer class="px-4 py-4 border-t border-primary/40 bg-black/20">
		<div class="flex items-center gap-3">
			<div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary font-semibold">
				{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
			</div>
			<div class="flex-1 min-w-0">
				<div class="text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
				<div class="text-xs text-white/80 truncate">{{ auth()->user()->role ?? 'Administrator' }}</div>
			</div>
			<form action="{{ route('logout') }}" method="POST" class="inline">
				@csrf
				<button type="submit" title="Logout">
					<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M21.25 20L26.25 15M26.25 15L21.25 10M26.25 15H8.75M16.25 20V21.25C16.25 22.2446 15.8549 23.1984 15.1517 23.9017C14.4484 24.6049 13.4946 25 12.5 25H7.5C6.50544 25 5.55161 24.6049 4.84835 23.9017C4.14509 23.1984 3.75 22.2446 3.75 21.25V8.75C3.75 7.75544 4.14509 6.80161 4.84835 6.09835C5.55161 5.39509 6.50544 5 7.5 5H12.5C13.4946 5 14.4484 5.39509 15.1517 6.09835C15.8549 6.80161 16.25 7.75544 16.25 8.75V10"
							stroke="white" stroke-opacity="0.7" stroke-width="1.25" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
			</form>
		</div>
	</footer>

</aside>

<!-- overlay for mobile when sidebar open -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/40 hidden z-30 md:hidden" aria-hidden="true"></div>