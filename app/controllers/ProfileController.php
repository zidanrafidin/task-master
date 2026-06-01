<?php
require_once 'app/controllers/Controller.php';
require_once 'app/models/ProfileModel.php';

class ProfileController extends Controller {
    private $profileModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/auth/login");
            exit;
        }
        $this->profileModel = new ProfileModel();
    }

    public function index() {
        $user_id = $_SESSION['user_id'];
        
        // 1. PROSES UPDATE NAMA & EMAIL
        if (isset($_POST['update_info'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);

            if (!empty($name) && !empty($email)) {
                // Pastikan email tidak dipakai orang lain
                if ($this->profileModel->checkEmailExists($email, $user_id)) {
                    $_SESSION['flash_error'] = "Email tersebut sudah digunakan oleh akun lain!";
                } else {
                    $this->profileModel->updateProfile($user_id, $name, $email);
                    $_SESSION['user_name'] = $name; // Update session nama agar di header langsung berubah
                    $_SESSION['flash_success'] = "Profil berhasil diperbarui!";
                }
            }
            header("Location: /taskmaster/profile");
            exit;
        }

        // 2. PROSES GANTI PASSWORD
        if (isset($_POST['update_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if (strlen($new_password) < 6) {
                $_SESSION['flash_error'] = "Password minimal 6 karakter!";
            } elseif ($new_password !== $confirm_password) {
                $_SESSION['flash_error'] = "Konfirmasi password tidak cocok!";
            } else {
                $this->profileModel->updatePassword($user_id, $new_password);
                $_SESSION['flash_success'] = "Password berhasil diubah!";
            }
            header("Location: /taskmaster/profile");
            exit;
        }

        // 3. PROSES UPLOAD FOTO
        if (isset($_POST['update_photo'])) {
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png'];
                $filename = $_FILES['photo']['name'];
                $file_tmp = $_FILES['photo']['tmp_name'];
                $file_size = $_FILES['photo']['size'];
                
                // Ambil ekstensi file
                $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Validasi ekstensi
                if (!in_array($file_ext, $allowed)) {
                    $_SESSION['flash_error'] = "Format file harus JPG, JPEG, atau PNG!";
                } 
                // Validasi ukuran (Maksimal 2MB)
                elseif ($file_size > 2097152) {
                    $_SESSION['flash_error'] = "Ukuran foto maksimal 2 MB!";
                } 
                else {
                    // Buat nama file unik (Mencegah nama file kembar menimpa satu sama lain)
                    $new_filename = 'user_' . $user_id . '_' . time() . '.' . $file_ext;
                    $upload_path = 'public/uploads/' . $new_filename;

                    // Pindahkan file dari folder temporary ke folder uploads kita
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        $this->profileModel->updatePhoto($user_id, $new_filename);
                        $_SESSION['flash_success'] = "Foto profil berhasil diperbarui!";
                    } else {
                        $_SESSION['flash_error'] = "Gagal mengunggah foto.";
                    }
                }
            } else {
                $_SESSION['flash_error'] = "Pilih foto terlebih dahulu!";
            }
            header("Location: /taskmaster/profile");
            exit;
        }

        // AMBIL DATA USER UNTUK DITAMPILKAN DI VIEW
        $user = $this->profileModel->getUserById($user_id);

        $this->view('profile/index', [
            'title' => 'Profil Saya - Task Master',
            'user' => $user
        ]);
    }
}
?>