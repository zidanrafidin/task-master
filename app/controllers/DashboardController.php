<?php
require_once 'app/controllers/Controller.php';

class DashboardController extends Controller {
    public function __construct() {
        // Mulai session
        session_start();
        
        // PROTEKSI HALAMAN (Middleware Sederhana)
        // Jika user mencoba masuk URL /dashboard tapi belum login, tendang ke halaman login
        if (!isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/auth/login");
            exit;
        }
    }

    public function index() {
        // Kirim data nama user dari Session ke View
        $data = [
            'title' => 'Dashboard - Task Master',
            'user_name' => $_SESSION['user_name']
        ];
        
        $this->view('dashboard/index', $data);
    }
}
?>