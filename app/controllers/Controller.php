<?php

class Controller {
    // Method untuk memanggil file View
    public function view($view, $data = []) {
        // extract() mengubah array ['nama' => 'Zidan'] menjadi variabel $nama = 'Zidan'
        extract($data);
        
        // Memanggil file view yang diminta
        require_once 'app/views/' . $view . '.php';
    }
}
?>