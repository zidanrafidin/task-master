<?php
require_once 'config/database.php';

class CategoryModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // CREATE: Tambah kategori baru
    public function create($user_id, $category_name) {
        $query = "INSERT INTO categories (user_id, category_name) VALUES (:user_id, :category_name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':category_name', $category_name);
        return $stmt->execute();
    }

    // READ: Ambil semua kategori milik user tertentu
    public function getAllByUserId($user_id) {
        $query = "SELECT * FROM categories WHERE user_id = :user_id ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // READ: Ambil 1 kategori spesifik untuk diedit
    public function getById($id, $user_id) {
        $query = "SELECT * FROM categories WHERE id = :id AND user_id = :user_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // UPDATE: Simpan perubahan nama kategori
    public function update($id, $user_id, $category_name) {
        $query = "UPDATE categories SET category_name = :category_name WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // DELETE: Hapus kategori
    public function delete($id, $user_id) {
        $query = "DELETE FROM categories WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
?>