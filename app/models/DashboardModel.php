<?php
require_once 'config/database.php';

class DashboardModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Menghitung total seluruh task
    public function countTotalTasks($user_id) {
        $query = "SELECT COUNT(id) as total FROM tasks WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['total'];
    }

    // Menghitung task berdasarkan status tertentu
    public function countTasksByStatus($user_id, $status) {
        $query = "SELECT COUNT(id) as total FROM tasks WHERE user_id = :user_id AND status = :status";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['total'];
    }

    // Menghitung total kategori yang dimiliki user
    public function countTotalCategories($user_id) {
        $query = "SELECT COUNT(id) as total FROM categories WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['total'];
    }

    // Mengambil 5 task terbaru untuk tabel di dashboard
    public function getRecentTasks($user_id, $limit = 5) {
        $query = "SELECT t.*, c.category_name 
                  FROM tasks t 
                  LEFT JOIN categories c ON t.category_id = c.id 
                  WHERE t.user_id = :user_id 
                  ORDER BY t.created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>