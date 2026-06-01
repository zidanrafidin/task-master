<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-6xl mx-auto w-full">
    <h1 class="text-4xl font-black uppercase tracking-tight mb-8">Profil Saya</h1>

    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="bg-[#a3e635] neo-box p-4 mb-8 font-bold text-lg inline-block w-full">
            ✅ <?= $_SESSION['flash_success']; ?>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="bg-red-400 neo-box p-4 mb-8 font-bold text-lg inline-block w-full text-black">
            ❌ <?= $_SESSION['flash_error']; ?>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="md:col-span-1">
            <div class="bg-white neo-box p-6 rounded-sm text-center">
                <h2 class="text-xl font-black uppercase mb-6 border-b-4 border-black pb-2">Foto Profil</h2>
                
                <div class="mb-6 flex justify-center">
                    <?php 
                        // Tentukan path gambar, gunakan default jika user belum upload
                        $photoPath = ($user['photo'] !== 'default.png' && !empty($user['photo'])) 
                                     ? '/taskmaster/public/uploads/' . $user['photo'] 
                                     : 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&background=facc15&color=000&bold=true&size=200';
                    ?>
                    <img src="<?= $photoPath ?>" alt="Foto Profil" class="w-48 h-48 object-cover rounded-full border-4 border-black shadow-[4px_4px_0px_#000]">
                </div>

                <form action="/taskmaster/profile" method="POST" enctype="multipart/form-data">
                    <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg" required class="w-full mb-4 p-2 border-4 border-black font-bold text-sm bg-gray-50 cursor-pointer">
                    <button type="submit" name="update_photo" class="w-full bg-[#c084fc] text-black font-black py-3 neo-btn rounded-sm">
                        UPLOAD FOTO
                    </button>
                </form>
            </div>
        </div>

        <div class="md:col-span-2 space-y-8">
            
            <div class="bg-white neo-box p-6 rounded-sm">
                <h2 class="text-2xl font-black uppercase mb-6 border-b-4 border-black pb-2">Informasi Akun</h2>
                <form action="/taskmaster/profile" method="POST" class="space-y-4">
                    <div>
                        <label class="block font-bold mb-2 text-lg">Nama Lengkap</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm">
                    </div>
                    <div>
                        <label class="block font-bold mb-2 text-lg">Alamat Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm">
                    </div>
                    <button type="submit" name="update_info" class="bg-[#facc15] text-black font-black py-3 px-8 neo-btn rounded-sm mt-2">
                        SIMPAN PERUBAHAN
                    </button>
                </form>
            </div>

            <div class="bg-white neo-box p-6 rounded-sm">
                <h2 class="text-2xl font-black uppercase mb-6 border-b-4 border-black pb-2 text-red-600">Ganti Password</h2>
                <form action="/taskmaster/profile" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold mb-2">Password Baru</label>
                            <input type="password" name="new_password" required minlength="6" class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm">
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" required minlength="6" class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm">
                        </div>
                    </div>
                    <button type="submit" name="update_password" class="bg-black text-white hover:bg-gray-800 font-black py-3 px-8 neo-btn rounded-sm mt-2 border-4 border-black">
                        UPDATE PASSWORD
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>