<?php

class Database {
    // Kredensial Database (Sesuaikan dengan settingan PostgreSQL kamu)
    private $host = "localhost";
    private $port = "5432";
    private $db_name = "taskmaster_db";
    private $username = "postgres"; // Default username PostgreSQL
    private $password = "123";     // Ubah sesuai password superuser postgres kamu!
    private $conn;

    // Method untuk mendapatkan koneksi database
    public function getConnection() {
        $this->conn = null;

        try {
            // DSN (Data Source Name) khusus untuk PostgreSQL
            $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            
            // Membuat instance PDO baru
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            // Mengatur Error Mode PDO menjadi Exception (agar error mudah dilacak)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Mengatur default fetch mode menjadi Associative Array
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch(PDOException $exception) {
            // Menangkap dan menampilkan pesan error jika koneksi gagal
            echo "<h3 style='color: red; font-family: sans-serif;'>❌ Koneksi Database Gagal: " . $exception->getMessage() . "</h3>";
        }

        return $this->conn;
    }
}

?>