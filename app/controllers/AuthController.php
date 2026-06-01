<?php
require_once 'app/controllers/Controller.php';
require_once 'app/models/AuthModel.php';

class AuthController extends Controller {
    private $authModel;

    public function __construct() {
        // Memulai session untuk seluruh fitur auth
        session_start();
        $this->authModel = new AuthModel();
    }

    public function login() {
        // Jika sudah login, tendang langsung ke dashboard
        if(isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/dashboard");
            exit;
        }

        $error = '';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $user = $this->authModel->login($email, $password);
            
            if($user) {
                // Set Session jika login berhasil
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                require_once 'app/models/ActivityModel.php';
                (new ActivityModel())->log($user['id'], "Berhasil login ke dalam sistem.");
                header("Location: /taskmaster/dashboard");
                exit;
            } else {
                $error = 'Email atau password salah!';
            }
        }

        $this->view('auth/login', ['title' => 'Login - Task Master', 'error' => $error]);
    }

    public function register() {
        if(isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/dashboard");
            exit;
        }

        $error = '';
        $success = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Validasi email
            if($this->authModel->checkEmail($email)) {
                $error = 'Email sudah terdaftar!';
            } else {
                // Eksekusi pendaftaran
                if($this->authModel->register($name, $email, $password)) {
                    $success = 'Registrasi berhasil! Silakan login.';
                } else {
                    $error = 'Gagal melakukan registrasi sistem.';
                }
            }
        }

        $this->view('auth/register', ['title' => 'Register - Task Master', 'error' => $error, 'success' => $success]);
    }

    public function logout() {
        session_start();
        session_unset();    // Hapus variabel session
        session_destroy();  // Hancurkan session
        header("Location: /taskmaster/auth/login");
        exit;
    }
}
?>