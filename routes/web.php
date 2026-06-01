<?php

class App {
    protected $controller = 'HomeController'; // Controller default
    protected $method = 'index';              // Method default
    protected $params = [];                   // Parameter tambahan

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Cek apakah file controller ada
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        // Panggil filenya & buat object (instance)
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Cek apakah method/fungsi di controller tersebut ada
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Ambil sisa URL sebagai parameter (jika ada)
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // 4. Jalankan controller, method, dan kirim parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            // Bersihkan URL dari karakter aneh dan pisahkan berdasarkan "/"
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
?>