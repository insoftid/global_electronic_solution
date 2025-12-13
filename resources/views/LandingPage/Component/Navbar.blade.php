<!-- Navbar component for Landing Page -->
<nav id="site-navbar" class="fixed bg-white/50 backdrop-blur-lg top-0 left-0 right-0 w-full z-50 transition-all">
	<style>
		:root{--ges-primary:#1F7654}
		/* underline animation for nav links */
		.nav-link{position:relative;display:inline-block}
		.nav-link::after{
			content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--ges-primary);transition:width .28s ease;
		}
		.nav-link:hover::after{width:100%}
		.nav-link.active::after{width:100%}
		/* small adjustment for mobile menu spacing */
		@media (max-width:767px){.nav-link::after{bottom:-8px}}
	</style>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between h-16 items-center">
			<!-- Left: brand -->
			<div class="flex items-center space-x-3">
				<a href="/" class="flex items-center gap-3">
					<span class="inline-flex items-center justify-center w-8 h-8 bg-primary rounded-md shadow-sm">
						<!-- simple mark inside square -->
						<svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
						</svg>
					</span>
					<span class="text-primary font-bold text-lg">Global Electronic Solution</span>
				</a>
			</div>

			<!-- Right: nav links -->
			<div class="hidden md:flex items-center space-x-6">
				<a href="/#tentang" class="nav-link text-md text-black hover:text-primary {{ (isset($active) && ( (is_array($active) && in_array('tentang',$active)) || $active === 'tentang')) ? 'active server-active' : '' }}">Tentang Kami</a>
				<a href="/portfolio" class="nav-link text-md text-black hover:text-primary {{ (isset($active) && ( (is_array($active) && in_array('portofolio',$active)) || $active === 'portofolio')) ? 'active server-active' : '' }}">Portofolio</a>
				<a href="/contact" class="nav-link text-md text-black hover:text-primary {{ (isset($active) && ( (is_array($active) && in_array('kontak',$active)) || $active === 'kontak')) ? 'active server-active' : '' }}">Kontak</a>
			</div>

			<!-- Mobile menu button -->
			<div class="md:hidden">
				<button id="nav-toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none">
					<svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Mobile menu (hidden by default) -->
	<div id="nav-menu" class="md:hidden hidden border-t border-gray-100">
		<!-- Use flex-col so items stack vertically on mobile -->
	<div class="px-4 pt-2 pb-3 flex flex-col items-start space-y-3">
			<a href="#tentang" class="nav-link inline-block text-md text-black hover:text-primary {{ (isset($active) && ( (is_array($active) && in_array('tentang',$active)) || $active === 'tentang')) ? 'active server-active' : '' }}">Tentang Kami</a>
			<a href="/portfolio" class="nav-link inline-block text-md text-black hover:text-primary {{ (isset($active) && ( (is_array($active) && in_array('portofolio',$active)) || $active === 'portofolio')) ? 'active server-active' : '' }}">Portofolio</a>
			<a href="/contact" class="nav-link inline-block text-md text-black hover:text-primary {{ (isset($active) && ( (is_array($active) && in_array('kontak',$active)) || $active === 'kontak')) ? 'active server-active' : '' }}">Kontak</a>
		</div>
	</div>

	</div>
	</nav>


	<script>
		// Minimal toggle for mobile menu and UI behaviors
		(function(){
			const btn = document.getElementById('nav-toggle');
			const menu = document.getElementById('nav-menu');
			if (btn && menu) {
				btn.addEventListener('click', function(){
					menu.classList.toggle('hidden');
				});
			}

			// Add blur/opacity/shadow effect when scrolling
			const navbar = document.getElementById('site-navbar');
			let onScroll = function(){};
			if (navbar) {
				onScroll = () => {
					if (window.scrollY > 10) {
						navbar.classList.add('shadow-md');
					} else {
						navbar.classList.remove('shadow-md');
					}
				};
				window.addEventListener('scroll', onScroll, { passive: true });
				// run once on load
				onScroll();
			}

			// Active link detection: server-side flag ($active) preferred,
			// otherwise try to infer from location.hash or pathname on the client.
			const setActiveFromLocation = () => {
				const links = document.querySelectorAll('.nav-link');
				const path = window.location.pathname || '/';
				const hash = window.location.hash || '';
				links.forEach(a => {
					// remove any previous client-side active (server-side may have set it already)
					if (!a.classList.contains('server-active')) {
						a.classList.remove('active');
					}
					const href = a.getAttribute('href') || '';
					// if the link is an anchor and matches current hash -> active
					if (href.startsWith('#') && hash && href === hash) {
						a.classList.add('active');
					} else if (href.startsWith('/') && (href === path || href === path + hash)) {
						a.classList.add('active');
					}
					// clicking a nav link should make it active client-side
					a.addEventListener('click', function(){
						links.forEach(x => x.classList.remove('active'));
						a.classList.add('active');
					});
				});
			};

			// Smooth scroll behavior for nav links that point to anchors on the same page
			const enableSmoothScroll = () => {
				const links = document.querySelectorAll('.nav-link');
				links.forEach(a => {
					const href = a.getAttribute('href') || '';
					if (!href.includes('#')) return; // not an anchor link
					a.addEventListener('click', function(e){
						// split path and hash
						const parts = href.split('#');
						const pathPart = parts[0] || '/';
						const hash = parts[1] ? '#' + parts[1] : '';
						const currentPath = window.location.pathname || '/';
						// If the link points to the root and user is on another page, navigate to '/'
						// first and store the desired hash so the landing page can scroll after load.
						if ((pathPart === '' || pathPart === '/') && currentPath !== '/') {
							e.preventDefault();
							if (hash) sessionStorage.setItem('scrollAfterNavigate', hash);
							window.location.href = '/';
							return;
						}
						// If link points to some other page, let browser navigate normally
						if (pathPart !== '' && pathPart !== '/' && pathPart !== currentPath) return;
						// same-page anchor -> smooth scroll
						e.preventDefault();
						if (!hash) return;
						const target = document.querySelector(hash);
						const navHeight = navbar ? navbar.offsetHeight : 0;
						if (target) {
							const top = target.getBoundingClientRect().top + window.scrollY - navHeight - 8;
							window.scrollTo({ top, behavior: 'smooth' });
							// close mobile menu if open
							if (menu && !menu.classList.contains('hidden')) menu.classList.add('hidden');
							// update active classes client-side
							links.forEach(x => x.classList.remove('active'));
							a.classList.add('active');
							// update URL hash without jumping
							history.pushState(null, '', hash);
						} else {
							// if target not found, still update hash so server-side routing or other logic can handle it
							history.pushState(null, '', hash);
						}
					});
				});
			};

			document.addEventListener('DOMContentLoaded', () => {
				setActiveFromLocation();
				enableSmoothScroll();
				// If navigation from another page stored a pending hash, perform smooth scroll now
				const pending = sessionStorage.getItem('scrollAfterNavigate');
				const doScrollToHash = (hash) => {
					if (!hash) return;
					const target = document.querySelector(hash);
					const navHeight = navbar ? navbar.offsetHeight : 0;
					if (target) {
						// small timeout to allow layout and any images to settle
						setTimeout(() => {
							const top = target.getBoundingClientRect().top + window.scrollY - navHeight - 8;
							window.scrollTo({ top, behavior: 'smooth' });
							// mark active link client-side
							const links = document.querySelectorAll('.nav-link');
							links.forEach(x => x.classList.remove('active'));
							const activeLink = Array.from(links).find(l => (l.getAttribute('href')||'').includes(hash));
							if (activeLink) activeLink.classList.add('active');
						}, 250);
					}
				};
				if (pending) {
					doScrollToHash(pending);
					sessionStorage.removeItem('scrollAfterNavigate');
				} else if (window.location.hash) {
					// direct load with hash -> smooth scroll as well
					doScrollToHash(window.location.hash);
				}
			});
			window.addEventListener('hashchange', setActiveFromLocation);

		})();
	</script>

