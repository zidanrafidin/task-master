<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-7xl mx-auto w-full">
    
    <header class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <h1 class="text-4xl font-black uppercase tracking-tight">Dashboard</h1>
        
        <div class="bg-white neo-box py-3 px-6 font-bold text-xl rounded-sm">
            Halo, <?= htmlspecialchars($user_name) ?>! 👋
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white neo-box neo-bg-blue p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2">Total Task</h3>
            <p class="text-6xl font-black">0</p>
        </div>
        <div class="bg-white neo-box neo-bg-green p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2">Task Selesai</h3>
            <p class="text-6xl font-black">0</p>
        </div>
        <div class="bg-white neo-box neo-bg-yellow p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2">In Progress</h3>
            <p class="text-6xl font-black">0</p>
        </div>
        <div class="bg-white neo-box neo-bg-pink p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2">Kategori</h3>
            <p class="text-6xl font-black">0</p>
        </div>
    </div>

    <div class="bg-white neo-box p-8 rounded-sm">
        <h2 class="text-2xl font-black mb-4 border-b-4 border-black pb-2 uppercase">Task Terbaru</h2>
        <div class="py-10 text-center border-4 border-dashed border-gray-300">
            <p class="font-bold text-gray-500 text-lg">Belum ada task. Mulai buat task pertamamu nanti!</p>
        </div>
    </div>

</div>

<?php require_once 'app/views/layouts/footer.php'; ?>