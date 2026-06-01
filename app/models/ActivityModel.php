<?php
require_once 'config/database.php';

class ActivityModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Fungsi untuk MENCATAT aktivitas baru
    public function log($user_id, $activity_description) {
        $query = "INSERT INTO activity_logs (user_id, activity) VALUES (:user_id, :activity)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':activity', $activity_description);
        return $stmt->execute();
    }

    // Fungsi untuk MENGAMBIL riwayat (Dibatasi 50 terakhir agar tidak berat)
    public function getRecentActivities($user_id, $limit = 50) {
        $query = "SELECT * FROM activity_logs WHERE user_id = :user_id ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>