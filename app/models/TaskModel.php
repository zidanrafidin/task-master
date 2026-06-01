<?php
require_once 'config/database.php';

class TaskModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // CREATE: Tambah task baru
    public function create($user_id, $category_id, $title, $description, $priority, $status, $deadline) {
        $query = "INSERT INTO tasks (user_id, category_id, title, description, priority, status, deadline) 
                  VALUES (:user_id, :category_id, :title, :description, :priority, :status, :deadline)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':deadline', $deadline);
        return $stmt->execute();
    }

    // READ: Ambil semua task milik user dengan JOIN ke tabel kategori
// READ: Ambil task dengan filter dinamis
    public function getFilteredTasks($user_id, $filters = []) {
        $query = "SELECT t.*, c.category_name 
                  FROM tasks t 
                  LEFT JOIN categories c ON t.category_id = c.id 
                  WHERE t.user_id = :user_id";
        
        // Array untuk menyimpan parameter binding
        $params = [':user_id' => $user_id];

        // 1. Filter Pencarian Teks (Judul atau Deskripsi) menggunakan ILIKE (PostgreSQL)
        if (!empty($filters['search'])) {
            $query .= " AND (t.title ILIKE :search OR t.description ILIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }
        
        // 2. Filter Kategori
        if (!empty($filters['category_id'])) {
            $query .= " AND t.category_id = :category_id";
            $params[':category_id'] = $filters['category_id'];
        }
        
        // 3. Filter Prioritas
        if (!empty($filters['priority'])) {
            $query .= " AND t.priority = :priority";
            $params[':priority'] = $filters['priority'];
        }
        
        // 4. Filter Status
        if (!empty($filters['status'])) {
            $query .= " AND t.status = :status";
            $params[':status'] = $filters['status'];
        }

        // Urutkan dari yang terbaru
        $query .= " ORDER BY t.created_at DESC";

        $stmt = $this->db->prepare($query);
        
        // Bind parameter secara dinamis menggunakan bindValue
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // READ: Ambil 1 task spesifik
    public function getById($id, $user_id) {
        $query = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // UPDATE: Simpan perubahan task
    public function update($id, $user_id, $category_id, $title, $description, $priority, $status, $deadline) {
        $query = "UPDATE tasks 
                  SET category_id = :category_id, title = :title, description = :description, 
                      priority = :priority, status = :status, deadline = :deadline 
                  WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // DELETE: Hapus task
    public function delete($id, $user_id) {
        $query = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
?>