<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-3xl mx-auto w-full flex flex-col items-center mt-10">
    <h1 class="text-4xl font-black uppercase tracking-tight mb-8">Edit Kategori</h1>

    <div class="bg-white neo-box p-8 rounded-sm w-full">
        <form action="/taskmaster/category/edit/<?= $category['id'] ?>" method="POST">
            <div class="mb-8">
                <label class="block font-bold mb-3 text-xl">Nama Kategori Baru</label>
                <input type="text" name="category_name" value="<?= htmlspecialchars($category['category_name']) ?>" required class="w-full p-4 border-4 border-black outline-none focus:shadow-[6px_6px_0px_#000] transition-all rounded-sm text-lg bg-gray-50">
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" name="update_category" class="flex-1 bg-[#a3e635] text-black font-black text-xl py-4 neo-btn rounded-sm">
                    UPDATE DATA
                </button>
                <a href="/taskmaster/category" class="flex-1 bg-gray-300 text-black text-center font-black text-xl py-4 neo-btn rounded-sm">
                    KEMBALI
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>