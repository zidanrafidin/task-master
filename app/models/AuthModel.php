<?php
require_once 'config/database.php';

class AuthModel {
    private $db;

    public function __construct() {
        // Menginisialisasi koneksi database saat model dipanggil
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Mengecek apakah email sudah dipakai sebelumnya
    public function checkEmail($email) {
        $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Menyimpan user baru ke database
    public function register($name, $email, $password) {
        // Hashing password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        
        return $stmt->execute();
    }

    // Mengecek data login
    public function login($email, $password) {
        $query = "SELECT id, name, email, password, photo FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Mencocokkan password yang diinput dengan hash di database
            if(password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
}
?>