<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-7xl mx-auto w-full">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-4xl font-black uppercase tracking-tight">Daftar Task</h1>
        <a href="/taskmaster/task/create" class="bg-[#facc15] text-black font-black text-lg py-3 px-8 neo-btn rounded-sm">
            + TAMBAH TASK
        </a>
    </div>

    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="bg-[#a3e635] neo-box p-4 mb-8 font-bold text-lg inline-block w-full text-center">
            ✅ <?= $_SESSION['flash_success']; ?>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <!-- WIDGET SEARCH & FILTER -->
    <div class="bg-[#c084fc] neo-box p-6 mb-8 rounded-sm">
        <form action="/taskmaster/task" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            
            <!-- Kolom Pencarian Teks (Lebih lebar) -->
            <div class="md:col-span-2">
                <input type="text" name="search" placeholder="Cari judul atau deskripsi..." 
                       value="<?= htmlspecialchars($filters['search']) ?>" 
                       class="w-full p-3 border-4 border-black outline-none font-bold bg-white focus:shadow-[4px_4px_0px_#000] rounded-sm transition-all">
            </div>

            <!-- Filter Kategori -->
            <div>
                <select name="category_id" class="w-full p-3 border-4 border-black outline-none font-bold bg-white focus:shadow-[4px_4px_0px_#000] rounded-sm cursor-pointer">
                    <option value="">Semua Kategori</option>
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= ($filters['category_id'] == $c['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filter Status -->
            <div>
                <select name="status" class="w-full p-3 border-4 border-black outline-none font-bold bg-white focus:shadow-[4px_4px_0px_#000] rounded-sm cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="Todo" <?= ($filters['status'] == 'Todo') ? 'selected' : '' ?>>Todo</option>
                    <option value="In Progress" <?= ($filters['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                    <option value="Done" <?= ($filters['status'] == 'Done') ? 'selected' : '' ?>>Done</option>
                </select>
            </div>

            <!-- Tombol Cari & Reset -->
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-black text-white font-black py-3 neo-btn rounded-sm border-4 border-black hover:bg-gray-800">
                    CARI
                </button>
                <a href="/taskmaster/task" class="flex-1 bg-white text-black font-black py-3 text-center neo-btn rounded-sm border-4 border-black">
                    RESET
                </a>
            </div>
        </form>
    </div>

    <!-- Grid Card Task (Sama seperti sebelumnya) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($tasks)): ?>
            <div class="col-span-full bg-white neo-box p-10 text-center text-gray-500 font-bold text-xl">
                Tidak ada task yang ditemukan.
            </div>
        <?php else: ?>
            <?php foreach ($tasks as $t): ?>
                <?php 
                    $prioColor = 'bg-gray-200';
                    if($t['priority'] == 'High') $prioColor = 'bg-[#f472b6]';
                    if($t['priority'] == 'Medium') $prioColor = 'bg-[#facc15]';
                    if($t['priority'] == 'Low') $prioColor = 'bg-[#a3e635]';

                    $statusIcon = '📋';
                    if($t['status'] == 'In Progress') $statusIcon = '⏳';
                    if($t['status'] == 'Done') $statusIcon = '✅';
                ?>
                <div class="bg-white neo-box p-6 flex flex-col justify-between h-full rounded-sm">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="<?= $prioColor ?> px-3 py-1 text-sm font-black uppercase border-2 border-black rounded-sm shadow-[2px_2px_0px_#000]">
                                <?= htmlspecialchars($t['priority']) ?>
                            </span>
                            <span class="bg-gray-100 px-3 py-1 text-sm font-bold border-2 border-black rounded-sm">
                                <?= $statusIcon ?> <?= htmlspecialchars($t['status']) ?>
                            </span>
                        </div>
                        <h3 class="text-2xl font-black mb-2 leading-tight"><?= htmlspecialchars($t['title']) ?></h3>
                        <p class="text-gray-700 font-medium mb-4 line-clamp-3">
                            <?= htmlspecialchars($t['description']) ?: 'Tidak ada deskripsi.' ?>
                        </p>
                    </div>
                    
                    <div class="border-t-4 border-black pt-4 mt-4 space-y-2">
                        <div class="flex justify-between text-sm font-bold">
                            <span>📁 <?= htmlspecialchars($t['category_name']) ?></span>
                            <span class="text-red-600">⏰ <?= $t['deadline'] ? date('d M Y', strtotime($t['deadline'])) : 'Tanpa batas' ?></span>
                        </div>
                        <div class="flex gap-2 pt-2">
                            <a href="/taskmaster/task/edit/<?= $t['id'] ?>" class="flex-1 text-center bg-[#38bdf8] text-black font-bold py-2 neo-btn rounded-sm">Edit</a>
                            <a href="/taskmaster/task/delete/<?= $t['id'] ?>" onclick="return confirm('Hapus task ini?');" class="flex-1 text-center bg-red-400 text-black font-bold py-2 neo-btn rounded-sm">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>