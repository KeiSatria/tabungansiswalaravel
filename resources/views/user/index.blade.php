<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Component CSS -->
    <style>
    /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
    /* So here we will write some classes to simulate dark mode and some of tailwind css config in our project */
    :root {
        --light: #edf2f9;
        --dark: #152e4d;
        --darker: #12263f;
    }

    .dark .dark\:text-light {
        color: var(--light);
    }

    .dark .dark\:bg-dark {
        background-color: var(--dark);
    }

    .dark .dark\:bg-darker {
        background-color: var(--darker);
    }

    .dark .dark\:text-gray-300 {
        color: #d1d5db;
    }

    .dark .dark\:text-indigo-700 {
        color: #4338ca;
    }

    .dark .dark\:text-indigo-500 {
        color: #6366f1;
    }

    .dark .dark\:text-indigo-100 {
        color: #e0e7ff;
    }

    .dark .dark\:hover\:text-light:hover {
        color: var(--light);
    }

    .dark .dark\:border-indigo-800 {
        border-color: #3730a3;
    }

    .dark .dark\:border-indigo-700 {
        border-color: #4338ca;
    }

    .dark .dark\:bg-indigo-600 {
        background-color: #4f46e5;
    }

    .dark .dark\:hover\:bg-indigo-600:hover {
        background-color: #4f46e5;
    }

    .dark .dark\:border-indigo-500 {
        border-color: #6366f1;
    }

    .dark .group:hover .dark\:group-hover\:text-indigo-400 {
        color: #818cf8;
    }

    .hover\:overflow-y-auto:hover {
        overflow-y: auto;
    }
</style>

<div x-data="setup()" x-init="$refs.loading.classList.add('hidden')" :class="{ 'dark': isDark}" @resize.window="watchScreen()">
    <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
        <!-- Loading screen -->
        <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-indigo-800">
            Loading.....
        </div>

        <!-- Sidebar first column -->
        <!-- Backdrop -->
        <div x-show="isSidebarOpen" @click="isSidebarOpen = false" class="fixed inset-0 z-10 bg-indigo-800 md:hidden" style="opacity: 0.5" aria-hidden="true"></div>

        <aside x-show="isSidebarOpen" x-transition:enter="transition-all transform duration-300 ease-in-out" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition-all transform duration-300 ease-in-out" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0" x-ref="sidebar" @keydown.escape="window.innerWidth <= 768 ? isSidebarOpen = false : ''" tabindex="-1" class="fixed inset-y-0 z-10 flex flex-shrink-0 bg-white border-r md:static dark:border-indigo-800 dark:bg-darker focus:outline-none">
            <!-- Mini column -->
            <nav class="flex flex-col flex-shrink-0 h-full px-2 py-4 border-r dark:border-indigo-800">
                <!-- Brand -->
                <div class="flex-shrink-0">
                <a class="inline-block text-xl font-bold tracking-wider text-indigo-700 uppercase dark:text-light">
                <center>Tabungan <br>Siswa </center></a>

            </div>
                <div class="flex flex-col items-center justify-center flex-1 space-y-4">
                    <a href="/user" class="p-2 text-white transition-colors duration-200 bg-indigo-600 rounded-full hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only text-right">Home</span>
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>  
                    <a href="/siswa" class="p-2 text-indigo-400 transition-colors duration-200 rounded-full bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only">Users</span>
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                  </div>
                    @if(auth()->check())
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center justify-center flex-shrink-0">
                    @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span>Logout</span>
                        <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        </button>
                    </form>
                    @endif
            </nav>
        </aside>


        <div class="flex flex-1 h-screen overflow-y-scroll">
            <!-- Main content -->
            <main class="flex-1">
                <header class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4 md:space-x-0">
                        <h1 class="text-2xl font-medium">User Dashboard</h1>
                    </div>

                    <div class="space-x-2">
                        <!-- Toggle dark theme button -->
                        <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                            <div class="w-12 h-6 transition bg-indigo-100 rounded-full outline-none dark:bg-indigo-400"></div>
                            <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm" :class="{ 'translate-x-0 -translate-y-px  bg-white text-indigo-700': !isDark, 'translate-x-6 text-indigo-100 bg-indigo-800': isDark }">
                                <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                                <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </button>
                </header>

    <!-- ISI -->

           
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <h1 class="text-2xl font-semibold text-gray-800 p-6">Profil {{ $user->name }}</h1>
    <div class="px-6 py-4 border-t">
        <h2 class="text-lg font-semibold text-gray-800">Data Siswa</h2>
        <div class="mt-4">
            <p class="text-sm text-gray-600"><span class="font-semibold">Nisn:</span> {{ $siswa->nisn }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold">Nama:</span> {{ $siswa->nama }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold">Tanggal Lahir:</span> {{ $siswa->tanggal_lahir }}</p>
            <p class="text-sm text-gray-600 mb-4"><span class="font-semibold">Nomor Telepon:</span> {{ $siswa->nomor_telepon }}</p>
            <a href="{{ route('user.editsiswa', $siswa->nisn) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md py-2 px-4 inline-flex items-center me-2">
                Ubah
            </a>
        </div>
    </div>
    <div class="px-6 py-4 border-t">
        <h2 class="text-lg font-semibold text-gray-800">Data Tabungan</h2>
        <div class="mt-4">
            <p class="text-sm text-gray-600"><span class="font-semibold">Nomor Tabungan:</span> {{ $tabungan->nomor_tabungan }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold">Nama:</span> {{ $tabungan->nama }}</p>
            <p class="text-sm text-gray-600"><span class="font-semibold">Saldo Kamu:</span> {{ $tabungan->saldo }}</p>
        </div>
        <p class="text-xs text-gray-500 mt-2">Note: Silakan hubungi admin untuk melakukan transaksi demi keamanan data dan untuk informasi lebih lanjut tentang tabungan Anda.</p>
    </div>
</div>

   
    
    <!-- Search panel -->
    <!-- Backdrop -->
    <div
        x-transition:enter="transition duration-300 ease-in-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300 ease-in-out"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-show="isSearchPanelOpen"
        @click="isSearchPanelOpen = false"
        class="fixed inset-0 z-10 bg-indigo-800"
        style="opacity: 0.5"
        aria-hidden="ture"
    ></div>
    <!-- Panel -->
    <section
        x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        x-show="isSearchPanelOpen"
        @keydown.escape="isSearchPanelOpen = false"
        class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
    >
        
 
 
        </div>
    </section>
    </div>
</div>
 
 

<script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/component.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script>
    const setup = () => {
        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }

        return {
            loading: true,
            isDark: getTheme(),
            toggleTheme() {
                this.isDark = !this.isDark
                setTheme(this.isDark)
            },
            setLightTheme() {
                this.isDark = false
                setTheme(this.isDark)
            },
            setDarkTheme() {
                this.isDark = true
                setTheme(this.isDark)
            },
            watchScreen() {
                if (window.innerWidth <= 768) {
                    this.isSidebarOpen = false
                    this.isUserPanelOpen = false
                } else if (window.innerWidth >= 768 && window.innerWidth < 1280) {
                    this.isSidebarOpen = true
                    this.isUserPanelOpen = false
                } else if (window.innerWidth >= 1280) {
                    this.isSidebarOpen = true
                    this.isUserPanelOpen = true
                }
            },
            isSidebarOpen: window.innerWidth >= 768 ? true : false,
            toggleSidbarMenu() {
                this.isSidebarOpen = !this.isSidebarOpen
            },
            isUserPanelOpen: window.innerWidth >= 1280 ? true : false,
            openUserPanel() {
                this.isUserPanelOpen = true
                this.$nextTick(() => {
                    this.$refs.userPanel.focus()
                })
            },
            isSettingsPanelOpen: false,
            openSettingsPanel() {
                this.isSettingsPanelOpen = true
                this.$nextTick(() => {
                    this.$refs.settingsPanel.focus()
                })
            },
            isNotificationsPanelOpen: false,
            openNotificationsPanel() {
                this.isNotificationsPanelOpen = true
                this.$nextTick(() => {                  
                    this.$refs.notificationsPanel.focus()
                })
            },
            isSearchPanelOpen: false,
            openSearchPanel() {
                this.isSearchPanelOpen = true
                this.$nextTick(() => {
                    this.$refs.searchInput.focus()
                })
            },
        }
    }
</script>

</html>

