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
            <h3 class="text-xl font-bold mb-2"><i class="bi bi-list-task mr-2"></i> Total Task</h3>
            <p class="text-6xl font-black"><?= $stats['total'] ?></p>
        </div>
        <div class="bg-white neo-box neo-bg-green p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2"><i class="bi bi-check-square-fill mr-2"></i> Task Selesai</h3>
            <p class="text-6xl font-black"><?= $stats['done'] ?></p>
        </div>
        <div class="bg-white neo-box neo-bg-yellow p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2"><i class="bi bi-hourglass-split mr-2"></i> In Progress</h3>
            <p class="text-6xl font-black"><?= $stats['progress'] ?></p>
        </div>
        <div class="bg-white neo-box neo-bg-pink p-6 rounded-sm">
            <h3 class="text-xl font-bold mb-2"><i class="bi bi-folder-fill mr-2"></i> Kategori</h3>
            <p class="text-6xl font-black"><?= $stats['categories'] ?></p>
        </div>
    </div>

    <div class="bg-white neo-box p-8 rounded-sm">
        <div class="flex justify-between items-center mb-6 border-b-4 border-black pb-2">
            <h2 class="text-2xl font-black uppercase">Task Terbaru</h2>
            <a href="/taskmaster/task" class="font-bold hover:underline text-blue-700">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <?php if (empty($recent_tasks)): ?>
            <div class="py-10 text-center border-4 border-dashed border-gray-300">
                <p class="font-bold text-gray-500 text-lg"><i class="bi bi-emoji-frown mr-2"></i> Belum ada task. Mulai buat task pertamamu!</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <tbody>
                        <?php foreach ($recent_tasks as $task): ?>
                            <?php 
                                // Penanda status dengan warna & icon
                                $statusBadge = '';
                                if($task['status'] == 'Todo') $statusBadge = '<span class="bg-gray-200 px-3 py-1 font-bold border-2 border-black rounded-sm text-sm"><i class="bi bi-circle"></i> Todo</span>';
                                if($task['status'] == 'In Progress') $statusBadge = '<span class="bg-[#facc15] px-3 py-1 font-bold border-2 border-black rounded-sm text-sm"><i class="bi bi-hourglass-split"></i> In Progress</span>';
                                if($task['status'] == 'Done') $statusBadge = '<span class="bg-[#a3e635] px-3 py-1 font-bold border-2 border-black rounded-sm text-sm"><i class="bi bi-check2-circle"></i> Done</span>';
                            ?>
                            <tr class="border-b-4 border-black last:border-0 hover:bg-gray-50">
                                <td class="p-4 w-16">
                                    <?php if($task['priority'] == 'High'): ?>
                                        <i class="bi bi-exclamation-triangle-fill text-red-500 text-2xl drop-shadow-[2px_2px_0px_#000]"></i>
                                    <?php else: ?>
                                        <i class="bi bi-journal-text text-gray-500 text-2xl"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <p class="font-black text-xl mb-1"><?= htmlspecialchars($task['title']) ?></p>
                                    <p class="font-bold text-gray-600 text-sm"><i class="bi bi-folder2"></i> <?= htmlspecialchars($task['category_name']) ?></p>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="font-bold text-red-600 bg-red-100 px-3 py-1 border-2 border-red-300 rounded-sm">
                                        <i class="bi bi-clock-history"></i> <?= $task['deadline'] ? date('d M Y', strtotime($task['deadline'])) : '-' ?>
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <?= $statusBadge ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require_once 'app/views/layouts/footer.php'; ?>