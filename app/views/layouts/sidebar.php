<!-- Navbar Mobile (Hanya muncul di HP) -->
    <div class="md:hidden flex items-center justify-between p-4 border-b-4 border-black bg-white z-20 sticky top-0">
        <h2 class="text-2xl font-black uppercase tracking-tighter">Task Master</h2>
        <button id="mobile-menu-btn" class="bg-[#a3e635] p-2 neo-btn rounded-sm flex items-center justify-center h-10 w-10">
            <i class="bi bi-list text-2xl font-black"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-72 bg-white border-r-4 border-black flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-40 shadow-[8px_0px_0px_rgba(0,0,0,0.2)] md:shadow-none h-screen">
        
        <!-- Logo Area (Desktop) & Tombol Tutup (Mobile) -->
        <div class="p-6 border-b-4 border-black neo-bg-purple flex justify-between items-center h-[76px] md:h-auto">
            <h2 class="text-2xl font-black uppercase tracking-tighter">Task Master</h2>
            <!-- Tombol Tutup (Hanya di Mobile) -->
            <button id="close-sidebar-btn" class="md:hidden bg-red-400 h-8 w-8 flex items-center justify-center neo-btn rounded-sm">
                <i class="bi bi-x-lg font-black"></i>
            </button>
        </div>
        
        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 space-y-4 overflow-y-auto">
            <a href="/taskmaster/dashboard" class="block w-full text-left font-bold text-lg p-3 neo-bg-green neo-btn rounded-sm">
                <i class="bi bi-grid-1x2-fill mr-2"></i> Dashboard
            </a>
            <a href="/taskmaster/category" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm">
                <i class="bi bi-folder-fill mr-2"></i> Kategori
            </a>
            <a href="/taskmaster/task" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm">
                <i class="bi bi-journal-check mr-2"></i> Task
            </a>
            <a href="/taskmaster/profile" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm">
                <i class="bi bi-person-fill mr-2"></i> Profil
            </a>
            <a href="/taskmaster/activity" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm mt-4">
                <i class="bi bi-clock-history mr-2"></i> Riwayat
            </a>
        </nav>

        <!-- Logout Area -->
        <div class="p-4 border-t-4 border-black bg-gray-100">
            <a href="/taskmaster/auth/logout" class="block w-full text-center font-bold text-lg p-3 bg-red-400 text-black neo-btn rounded-sm hover:bg-red-500">
                <i class="bi bi-box-arrow-right mr-2"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Overlay Gelap (Hanya muncul saat menu HP terbuka) -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <!-- Pembungkus Konten Utama -->
    <main class="flex-1 h-[calc(100vh-76px)] md:h-screen overflow-y-auto bg-[#facc15] bg-opacity-20 relative">