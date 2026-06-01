<aside class="w-64 bg-white border-r-4 border-black flex flex-col hidden md:flex z-10">
        <div class="p-6 border-b-4 border-black neo-bg-purple">
            <h2 class="text-2xl font-black uppercase tracking-tighter">Task Master</h2>
        </div>
        
        <nav class="flex-1 p-4 space-y-4">
            <a href="/taskmaster/dashboard" class="block w-full text-left font-bold text-lg p-3 neo-bg-green neo-btn rounded-sm">
                📊 Dashboard
            </a>
            <a href="/taskmaster/category" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm">
                📁 Kategori
            </a>
            <a href="/taskmaster/task" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm">
                📝 Task
            </a>
            <a href="/taskmaster/profile" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm">
                👤 Profil
            </a>
            <a href="/taskmaster/activity" class="block w-full text-left font-bold text-lg p-3 bg-white hover:bg-gray-100 neo-btn rounded-sm mt-4">
                🕒 Riwayat
            </a>
        </nav>

        <div class="p-4 border-t-4 border-black bg-gray-100">
            <a href="/taskmaster/auth/logout" class="block w-full text-center font-bold text-lg p-3 bg-red-400 text-black neo-btn rounded-sm hover:bg-red-500">
                🚪 Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-[#facc15] bg-opacity-20">