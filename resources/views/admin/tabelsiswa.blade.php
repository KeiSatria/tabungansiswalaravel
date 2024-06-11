<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<!-- component -->
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
                        <center>
                             Tabungan  <br>
                             Siswa </center>
                    </a>
                </div>
                <div class="flex flex-col items-center justify-center flex-1 space-y-4">
                    <!-- Home link -->
                    <!-- Active classes "bg-indigo-600 text-white" -->
                    <!-- inActive classes "bg-indigo-50 text-indigo-400" -->
                    <a href="/admin/siswa/index" class="p-2 text-white transition-colors duration-200 bg-indigo-600 rounded-full hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only text-right">Home</span>
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>
                    
                    <a href="/admin/tabungan" class="p-2 text-indigo-400 transition-colors duration-200 rounded-full bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only">Data Tabungan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                        </svg>
                    </a>
                
                    <a href="/admin/datalengkap" class="p-2 text-indigo-400 transition-colors duration-200 rounded-full bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only">Data Lengkap</span>
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </a>
                  
                    <a href="/admin/siswa" class="p-2 text-indigo-400 transition-colors duration-200 rounded-full bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only">Users</span>
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                    </a>
                
                    <a href="/users" class="p-2 text-indigo-400 transition-colors duration-200 rounded-full bg-indigo-50 hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-700 focus:ring-indigo-800">
                        <span class="sr-only">Kelola Akun</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </a>

                </div>
            
                @if(auth()->check())
    <form action="{{ route('logout') }}" method="POST" class="flex items-center justify-center flex-shrink-0">
        @csrf
        <!-- Logout button -->
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
                        <!-- Sidebar button -->
                        <button @click="isSidebarOpen = true; $nextTick(() => { $refs.sidebar.focus() })" class="p-1 text-indigo-400 transition-colors duration-200 rounded-md bg-indigo-50 md:hidden hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:ring">
                            <span class="sr-only">Open main manu</span>
                            <span aria-hidden="true">
                                <svg x-show="!isSidebarOpen" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <svg x-show="isSidebarOpen" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </span>
                        </button>
                        <h1 class="text-2xl font-medium">Data Siswa</h1>
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
                       
                        <!-- User panel button -->
                        <button @click="openUserPanel" class="p-1 text-indigo-400 transition-colors duration-200 rounded-md bg-indigo-50 xl:hidden hover:text-indigo-600 hover:bg-indigo-100 dark:hover:text-light dark:hover:bg-indigo-700 dark:bg-dark focus:outline-none focus:ring">
                            <span class="sr-only">Open user panel</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </header>
                <div style="display: flex; justify-content: center;">
    <a href="/admin/siswa/tambah" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="padding: 10px 20px; margin-right: 10px;">
        Tambah Data
    </a>
</div>
<script>
    function showNotification() {
        var notificationMessage = "Data telah disimpan!";
        localStorage.setItem("notificationMessage", notificationMessage);
    }

    window.onload = function() {
        var notificationMessage = localStorage.getItem("notificationMessage");
        if (notificationMessage) {
            alert(notificationMessage);
            localStorage.removeItem("notificationMessage");
        }
    };
</script>

<br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Siswa</title>
    <!-- Tambahkan link ke file CSS Anda jika Anda menyimpannya secara terpisah -->
    <style>
        /* Garis untuk seluruh elemen tabel */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #e2e8f0; /* Warna garis tabel */
        }

        /* Garis untuk seluruh sel dalam tabel kecuali header */
        td {
            border: 1px solid #e2e8f0; /* Warna garis sel */
            padding: 8px;
        }

        /* Garis untuk header tabel */
        th {
            border: 1px solid #e2e8f0; /* Warna garis header */
            padding: 8px;
            background-color: #f7fafc; /* Warna latar belakang header */
            color: #4a5568; /* Warna teks header */
        }
    </style>
</head>
<body>
<div class="mb-4 flex">
    <form action="{{ url('/admin/siswa/cari') }}" method="GET" class="flex">
        <input type="text" name="cari" placeholder="Cari siswa..." class="border border-gray-300 p-2 rounded-md">
        <button type="submit" name="submit" value="search" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Cari
</button>
   </form>
</div>



<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800">NISN</th>
            <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800">Nama</th>
            <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800">Tanggal_Lahir</th>
            <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800">Nomor Telepon</th>
            <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800">Pilihan</th>
        </tr>
    </thead>
    <tbody>

        @foreach($siswa as $p)
        <tr class="table-dark">
            <td scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                {{ $p->nisn }}
            </td>
            <td scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                {{ $p->nama }}
            </td>
            <td scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                {{ $p->tanggal_lahir }}
            </td>
            <td scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                {{ $p->nomor_telepon }}
            </td>
            <td scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">

                <a href="/admin/siswa/edit/{{ $p->nisn }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ubah
                </a>

                <a href="/admin/siswa/hapus/{{ $p->nisn }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"onclick="return confirmAndNotify(event, 'Apakah Anda Ingin Menghapus Data Ini?');">
                    Hapus
                </a>
                <script>
    function confirmAndNotify(event, message) {
        if (confirm(message)) {
            alert("Data berhasil dihapus");
            return true; // untuk melanjutkan navigasi
        } else {
            event.preventDefault(); // untuk mencegah navigasi jika pengguna membatalkan
            return false;
        }
    }
</script>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
</div>
</main>
  
    <!-- Panel -->
    <section
        x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        x-ref="settingsPanel"
        tabindex="-1"
        x-show="isSettingsPanelOpen"
        @keydown.escape="isSettingsPanelOpen = false"
        class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
        aria-labelledby="settinsPanelLabel"
    >
        <div class="absolute left-0 p-2 transform -translate-x-full">
        <!-- Close button -->
        <button
            @click="isSettingsPanelOpen = false"
            class="p-2 text-white rounded-md focus:outline-none focus:ring"
        >
            <svg
            class="w-5 h-5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        </div>
        <!-- Panel content -->
        <div class="flex flex-col h-screen">
        <!-- Panel header -->
        <div
            class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-indigo-700"
        >
            <span aria-hidden="true" class="text-gray-500 dark:text-indigo-600">
            <svg
                class="w-8 h-8"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                />
            </svg>
            </span>
            <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">Settings</h2>
        </div>
        <!-- Content -->
        <div class="flex-1 overflow-hidden hover:overflow-y-auto">
            <!-- Theme -->
            <div class="p-4 space-y-4 md:p-8">
            <h6 class="text-lg font-medium text-gray-400 dark:text-light">Mode</h6>
            <div class="flex items-center space-x-8">
                <!-- Light button -->
                <button
                @click="setLightTheme"
                class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-indigo-600 dark:hover:text-indigo-100 dark:hover:border-indigo-500 focus:outline-none focus:ring focus:ring-indigo-400 dark:focus:ring-indigo-700"
                :class="{ 'border-gray-900 text-gray-900 dark:border-indigo-500 dark:text-indigo-100': !isDark, 'text-gray-500 dark:text-indigo-500': isDark }"
                >
                <span>
                    <svg
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                    />
                    </svg>
                </span>
                <span>Light</span>
                </button>

                <!-- Dark button -->
                <button
                @click="setDarkTheme"
                class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-indigo-600 dark:hover:text-indigo-100 dark:hover:border-indigo-500 focus:outline-none focus:ring focus:ring-indigo-400 dark:focus:ring-indigo-700"
                :class="{ 'border-gray-900 text-gray-900 dark:border-indigo-500 dark:text-indigo-100': isDark, 'text-gray-500 dark:text-indigo-500': !isDark }"
                >
                <span>
                    <svg
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                    />
                    </svg>
                </span>
                <span>Dark</span>
                </button>
            </div>
            </div>

            <!--  -->
            <div class="p-4 space-y-4 md:p-8">
            <!--  -->
            </div>
        </div>
        </div>
    </section>

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