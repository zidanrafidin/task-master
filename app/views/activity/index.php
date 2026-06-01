<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-4xl mx-auto w-full">
    <h1 class="text-4xl font-black uppercase tracking-tight mb-8">Riwayat Aktivitas</h1>

    <div class="bg-white neo-box p-8 rounded-sm">
        <?php if (empty($activities)): ?>
            <div class="text-center p-8 border-4 border-dashed border-gray-300 font-bold text-gray-500 text-xl">
                Belum ada aktivitas yang terekam.
            </div>
        <?php else: ?>
            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-1 before:bg-black">
                
                <?php foreach ($activities as $act): ?>
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-black bg-[#a3e635] text-black shadow-[4px_4px_0px_#000] shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                            ⚡
                        </div>
                        
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-[#facc15] neo-box p-4 rounded-sm">
                            <div class="flex flex-col">
                                <span class="font-bold text-lg"><?= htmlspecialchars($act['activity']) ?></span>
                                <time class="text-sm font-bold text-gray-700 mt-2 border-t-2 border-black pt-1">
                                    🗓️ <?= date('d M Y, H:i', strtotime($act['created_at'])) ?> WIB
                                </time>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>