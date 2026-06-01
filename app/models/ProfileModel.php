<?php
require_once 'config/database.php';

class ProfileModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Mengambil data user berdasarkan ID
    public function getUserById($id) {
        $query = "SELECT id, name, email, photo FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Mengecek apakah email sudah dipakai oleh user LAIN
    public function checkEmailExists($email, $current_user_id) {
        $query = "SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $current_user_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Update Nama dan Email
    public function updateProfile($id, $name, $email) {
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Update Password Baru
    public function updatePassword($id, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Update Nama File Foto Profil
    public function updatePhoto($id, $photo_name) {
        $query = "UPDATE users SET photo = :photo WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':photo', $photo_name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>