<?php
require_once 'app/controllers/Controller.php';

class HomeController extends Controller {
    public function index() {
        // Data dinamis yang akan dikirim ke View
        $data = [
            'title' => 'Task Master',
            'tagline' => 'Manajemen Tugas Brutal, Fokus Maksimal.'
        ];
        
        // Memanggil View 'home/index' dengan membawa $data
        $this->view('home/index', $data);
    }
}
?>