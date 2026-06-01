<?php require_once 'app/views/layouts/header.php'; ?>
<?php require_once 'app/views/layouts/sidebar.php'; ?>

<div class="p-8 max-w-4xl mx-auto w-full">
    <div class="bg-white neo-box p-8 rounded-sm">
        <h1 class="text-3xl font-black uppercase mb-8 border-b-4 border-black pb-4">Edit Task</h1>
        
        <form action="/taskmaster/task/edit/<?= $task['id'] ?>" method="POST" class="space-y-6">
            <div>
                <label class="block font-bold mb-2 text-lg">Judul Task *</label>
                <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-bold mb-2 text-lg">Kategori *</label>
                    <select name="category_id" required class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm cursor-pointer">
                        <?php foreach($categories as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= ($task['category_id'] == $c['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['category_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <?php 
                        // Format deadline dari timestamp DB menjadi YYYY-MM-DD untuk input date HTML
                        $deadline_val = $task['deadline'] ? date('Y-m-d', strtotime($task['deadline'])) : ''; 
                    ?>
                    <label class="block font-bold mb-2 text-lg">Deadline</label>
                    <input type="date" name="deadline" value="<?= $deadline_val ?>" class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-bold mb-2 text-lg">Prioritas</label>
                    <select name="priority" class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm cursor-pointer">
                        <option value="Low" <?= ($task['priority'] == 'Low') ? 'selected' : '' ?>>Low</option>
                        <option value="Medium" <?= ($task['priority'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                        <option value="High" <?= ($task['priority'] == 'High') ? 'selected' : '' ?>>High</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold mb-2 text-lg">Status</label>
                    <select name="status" class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm cursor-pointer">
                        <option value="Todo" <?= ($task['status'] == 'Todo') ? 'selected' : '' ?>>Todo</option>
                        <option value="In Progress" <?= ($task['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                        <option value="Done" <?= ($task['status'] == 'Done') ? 'selected' : '' ?>>Done</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold mb-2 text-lg">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full p-3 border-4 border-black outline-none focus:shadow-[4px_4px_0px_#000] bg-gray-50 rounded-sm"><?= htmlspecialchars($task['description']) ?></textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-[#38bdf8] text-black font-black text-xl py-4 neo-btn rounded-sm">UPDATE TASK</button>
                <a href="/taskmaster/task" class="flex-1 bg-gray-300 text-black text-center font-black text-xl py-4 neo-btn rounded-sm">BATAL</a>
            </div>
        </form>
    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>