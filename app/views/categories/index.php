<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-7xl mx-auto w-full">
    <h1 class="text-4xl font-black uppercase tracking-tight mb-8">Manajemen Kategori</h1>

    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="bg-[#a3e635] neo-box p-4 mb-8 font-bold text-lg border-4 border-black inline-block">
            ✅ <?= $_SESSION['flash_success']; ?>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white neo-box p-6 rounded-sm sticky top-8">
                <h2 class="text-2xl font-black mb-6 uppercase border-b-4 border-black pb-2">Tambah Baru</h2>
                <form action="/taskmaster/category/index" method="POST">
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Nama Kategori</label>
                        <input type="text" name="category_name" required class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] transition-all rounded-sm bg-gray-50" placeholder="Misal: Kuliah, Pribadi...">
                    </div>
                    <button type="submit" name="add_category" class="w-full bg-[#facc15] text-black font-black text-xl py-3 neo-btn rounded-sm">
                        SIMPAN
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white neo-box p-0 rounded-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#c084fc] border-b-4 border-black text-xl">
                            <th class="p-4 font-black uppercase border-r-4 border-black w-16 text-center">No</th>
                            <th class="p-4 font-black uppercase border-r-4 border-black">Nama Kategori</th>
                            <th class="p-4 font-black uppercase text-center w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categories)): ?>
                            <tr>
                                <td colspan="3" class="p-8 text-center font-bold text-gray-500 text-lg border-b-4 border-black">
                                    Belum ada kategori yang dibuat.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($categories as $cat): ?>
                                <tr class="border-b-4 border-black last:border-b-0 hover:bg-gray-100 transition-colors">
                                    <td class="p-4 font-bold border-r-4 border-black text-center"><?= $no++ ?></td>
                                    <td class="p-4 font-bold border-r-4 border-black text-lg"><?= htmlspecialchars($cat['category_name']) ?></td>
                                    <td class="p-4 text-center space-x-2">
                                        <a href="/taskmaster/category/edit/<?= $cat['id'] ?>" class="inline-block bg-[#38bdf8] text-black font-bold px-3 py-1 neo-btn rounded-sm">Edit</a>
                                        <a href="/taskmaster/category/delete/<?= $cat['id'] ?>" onclick="return confirm('Yakin menghapus kategori ini?');" class="inline-block bg-red-400 text-black font-bold px-3 py-1 neo-btn rounded-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>