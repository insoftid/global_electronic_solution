@if (isset($active) && $active === 'dashboard')
    <header
        class="w-full fixed bg-white border-b border-gray-300 px-4 py-4 md:pb-4 md:pt-5 flex items-center justify-between md:pl-72">
@else
        <header
            class="w-full fixed bg-white border-b border-gray-300 px-4 py-4 md:py-5 flex items-center justify-between md:pl-72">
    @endif
        <div class="flex items-center gap-3">
            <!-- Sidebar toggle (visible on small screens) -->
            <button id="sidebar-toggle" aria-controls="admin-sidebar" aria-expanded="false"
                class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none"
                title="Toggle sidebar">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" aria-hidden="true">
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
                        <path
                            d="M18 17V18H0V17L2 15V9C2 5.9 4.03 3.17 7 2.29V2C7 1.46957 7.21071 0.960859 7.58579 0.585786C7.96086 0.210714 8.46957 0 9 0C9.53043 0 10.0391 0.210714 10.4142 0.585786C10.7893 0.960859 11 1.46957 11 2V2.29C13.97 3.17 16 5.9 16 9V15L18 17ZM11 19C11 19.5304 10.7893 20.0391 10.4142 20.4142C10.0391 20.7893 9.53043 21 9 21C8.46957 21 7.96086 20.7893 7.58579 20.4142C7.21071 20.0391 7 19.5304 7 19"
                            fill="black" />
                    </svg>

                    <span
                        class="absolute right-2 top-2 bg-red-500 text-white rounded-full px-2 py-1 text-[10px]">{{ $slot ?? '' }}</span>
                </a>
            </div>
        @endif

        <script>
            (function () {
                const btn = document.getElementById('sidebar-toggle');
                const sidebar = document.getElementById('admin-sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                if (!btn || !sidebar) return;

                function openSidebar() {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    if (overlay) overlay.classList.remove('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                }
                function closeSidebar() {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    if (overlay) overlay.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }

                btn.addEventListener('click', function () {
                    const expanded = btn.getAttribute('aria-expanded') === 'true';
                    if (expanded) closeSidebar(); else openSidebar();
                });

                if (overlay) overlay.addEventListener('click', closeSidebar);

                // ensure sidebar is visible on resize >= md
                window.addEventListener('resize', function () {
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

        {{-- Global Admin Helper Functions --}}
        <script>
            /**
             * Format API error response into detailed error message
             * @param {Response} response - Fetch API response object
             * @param {Object} result - Parsed JSON response body
             * @returns {Object} Formatted error object with title, message, and details
             */
            window.formatApiError = function (response, result) {
                const status = response.status;
                const errorObj = {
                    title: 'Error',
                    message: '',
                    details: [],
                    httpStatus: status
                };

                // Handle validation errors (422)
                if (status === 422 && result.errors) {
                    errorObj.title = 'Validasi Gagal';
                    const fieldErrors = [];

                    // Map common field names to Indonesian
                    const fieldLabels = {
                        'title': 'Judul',
                        'name': 'Nama',
                        'email': 'Email',
                        'password': 'Password',
                        'description': 'Deskripsi',
                        'detail': 'Detail',
                        'thumbnail': 'Thumbnail',
                        'image': 'Gambar',
                        'logo': 'Logo',
                        'category_id': 'Kategori',
                        'youtube_url': 'URL YouTube',
                        'project_date': 'Tanggal Proyek',
                        'website_url': 'URL Website',
                        'company_name': 'Nama Perusahaan',
                        'tagline': 'Tagline',
                        'whatsapp': 'WhatsApp',
                        'address': 'Alamat',
                        'about_description': 'Deskripsi Tentang Kami',
                        'about_vision': 'Visi',
                        'about_mission': 'Misi',
                        'quality_policy': 'Kebijakan Mutu',
                        'images': 'Gambar',
                        'images.*': 'File Gambar'
                    };

                    for (const [field, messages] of Object.entries(result.errors)) {
                        const fieldLabel = fieldLabels[field] || field.charAt(0).toUpperCase() + field.slice(1).replace(/_/g, ' ');
                        messages.forEach(msg => {
                            // Replace field name in message with Indonesian label
                            let translatedMsg = msg
                                .replace(new RegExp(`\\b${field}\\b`, 'gi'), fieldLabel.toLowerCase())
                                .replace('field ', '')
                                .replace('The ', '');
                            fieldErrors.push(`• ${fieldLabel}: ${translatedMsg}`);
                        });
                    }

                    errorObj.message = result.message || 'Data yang dimasukkan tidak valid';
                    errorObj.details = fieldErrors;
                }
                // Handle server errors (500)
                else if (status >= 500) {
                    errorObj.title = 'Server Error';
                    errorObj.message = result.message || 'Terjadi kesalahan pada server';
                    if (result.error) {
                        errorObj.details.push(`• Detail: ${result.error}`);
                    }
                    if (result.exception) {
                        errorObj.details.push(`• Exception: ${result.exception}`);
                    }
                }
                // Handle unauthorized (401)
                else if (status === 401) {
                    errorObj.title = 'Sesi Berakhir';
                    errorObj.message = 'Silakan login kembali untuk melanjutkan';
                }
                // Handle forbidden (403)
                else if (status === 403) {
                    errorObj.title = 'Akses Ditolak';
                    errorObj.message = result.message || 'Anda tidak memiliki izin untuk melakukan aksi ini';
                }
                // Handle not found (404)
                else if (status === 404) {
                    errorObj.title = 'Tidak Ditemukan';
                    errorObj.message = result.message || 'Data yang diminta tidak ditemukan';
                }
                // Handle other errors
                else {
                    errorObj.title = 'Operasi Gagal';
                    errorObj.message = result.message || 'Terjadi kesalahan yang tidak diketahui';
                    if (result.error) {
                        errorObj.details.push(`• ${result.error}`);
                    }
                }

                return errorObj;
            }

            /**
             * Show toast notification with support for detailed error display
             * @param {string|Object} messageOrError - Message string or error object from formatApiError
             * @param {string} type - 'success', 'error', 'info', 'warning'
             * @param {number} duration - Duration in ms (default 5000 for errors, 3000 for success)
             */
            window.showToast = function (messageOrError, type = 'success', duration = null) {
                // Get or create toast container
                let container = document.getElementById('toast-container');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'toast-container';
                    container.className = 'fixed top-5 right-5 z-50 space-y-2';
                    container.style.maxWidth = '400px';
                    document.body.appendChild(container);
                }

                const toast = document.createElement('div');

                // Determine colors and icons based on type
                const styles = {
                    success: { bg: 'bg-green-500', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' },
                    error: { bg: 'bg-red-500', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' },
                    info: { bg: 'bg-blue-500', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' },
                    warning: { bg: 'bg-yellow-500', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>' }
                };

                const style = styles[type] || styles.success;
                const defaultDuration = type === 'error' ? 6000 : 4000;
                const actualDuration = duration || defaultDuration;

                // Handle error object from formatApiError
                let content = '';
                if (typeof messageOrError === 'object' && messageOrError.title) {
                    const errorObj = messageOrError;
                    content = `
                    <div class="font-semibold text-sm">${errorObj.title}</div>
                    <div class="text-sm opacity-90">${errorObj.message}</div>
                    ${errorObj.details && errorObj.details.length > 0 ? `
                        <div class="mt-2 text-xs opacity-80 max-h-32 overflow-y-auto">
                            ${errorObj.details.join('<br>')}
                        </div>
                    ` : ''}
                    ${errorObj.httpStatus ? `<div class="text-xs opacity-60 mt-1">HTTP ${errorObj.httpStatus}</div>` : ''}
                `;
                } else {
                    content = `<span class="text-sm font-medium">${messageOrError}</span>`;
                }

                toast.className = `${style.bg} text-white px-4 py-3 rounded-lg shadow-lg flex items-start gap-3 transform translate-x-full transition-transform duration-300`;
                toast.innerHTML = `
                <span class="flex-shrink-0 mt-0.5">${style.icon}</span>
                <div class="flex-1 min-w-0">${content}</div>
                <button class="flex-shrink-0 hover:opacity-80 mt-0.5" onclick="this.parentElement.remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            `;

                container.appendChild(toast);

                // Animate in
                requestAnimationFrame(() => {
                    toast.classList.remove('translate-x-full');
                    toast.classList.add('translate-x-0');
                });

                // Auto dismiss
                setTimeout(() => {
                    toast.classList.remove('translate-x-0');
                    toast.classList.add('translate-x-full');
                    setTimeout(() => toast.remove(), 300);
                }, actualDuration);

                return toast;
            }

            /**
             * Set button loading state with spinner
             * @param {HTMLButtonElement} button - Button element
             * @param {boolean} isLoading - Loading state
             */
            window.setButtonLoading = function (button, isLoading) {
                if (!button) return;

                if (isLoading) {
                    button.disabled = true;
                    button.dataset.originalText = button.innerHTML;
                    button.innerHTML = `
                    <svg class="animate-spin h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Memproses...
                `;
                    button.classList.add('opacity-70', 'cursor-not-allowed');
                } else {
                    button.disabled = false;
                    button.innerHTML = button.dataset.originalText || 'Simpan';
                    button.classList.remove('opacity-70', 'cursor-not-allowed');
                }
            }

            /**
             * Handle API response and show appropriate toast
             * @param {Response} response - Fetch API response
             * @param {Object} result - Parsed JSON result
             * @param {string} successMessage - Custom success message (optional)
             * @returns {boolean} True if successful, false otherwise
             */
            window.handleApiResponse = function (response, result, successMessage = null) {
                if (response.ok && result.success) {
                    showToast(successMessage || result.message || 'Operasi berhasil', 'success');
                    return true;
                } else {
                    const errorObj = formatApiError(response, result);
                    showToast(errorObj, 'error');
                    return false;
                }
            }
        </script>
    </header>