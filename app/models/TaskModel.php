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
    public function getAllByUserId($user_id) {
        $query = "SELECT t.*, c.category_name 
                  FROM tasks t 
                  LEFT JOIN categories c ON t.category_id = c.id 
                  WHERE t.user_id = :user_id 
                  ORDER BY t.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
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