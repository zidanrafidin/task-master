<?php
require_once 'app/controllers/Controller.php';
require_once 'app/models/CategoryModel.php';

class CategoryController extends Controller {
    private $categoryModel;

    public function __construct() {
        session_start();
        // Proteksi Halaman
        if (!isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/auth/login");
            exit;
        }
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan halaman list & menangani form tambah kategori
    public function index() {
        $user_id = $_SESSION['user_id'];

        // Menangkap request POST untuk Tambah Kategori
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
            $category_name = trim($_POST['category_name']);
            if (!empty($category_name)) {
                $this->categoryModel->create($user_id, $category_name);
                $_SESSION['flash_success'] = "Kategori berhasil ditambahkan!";
                header("Location: /taskmaster/category");
                exit;
            }
        }

        // Mengambil data untuk View
        $categories = $this->categoryModel->getAllByUserId($user_id);
        
        $data = [
            'title' => 'Kategori - Task Master',
            'categories' => $categories
        ];
        
        $this->view('categories/index', $data);
    }

    // Menangani form edit kategori
    public function edit($id = null) {
        if ($id === null) { header("Location: /taskmaster/category"); exit; }
        
        $user_id = $_SESSION['user_id'];
        
        // Ambil data kategori yang mau diedit, jika tidak ketemu tendang kembali
        $category = $this->categoryModel->getById($id, $user_id);
        if (!$category) { header("Location: /taskmaster/category"); exit; }

        // Menangkap request POST untuk Update
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_category'])) {
            $category_name = trim($_POST['category_name']);
            if (!empty($category_name)) {
                $this->categoryModel->update($id, $user_id, $category_name);
                $_SESSION['flash_success'] = "Kategori berhasil diperbarui!";
                header("Location: /taskmaster/category");
                exit;
            }
        }

        $data = [
            'title' => 'Edit Kategori - Task Master',
            'category' => $category
        ];
        $this->view('categories/edit', $data);
    }

    // Menangani penghapusan kategori
    public function delete($id = null) {
        if ($id !== null) {
            $user_id = $_SESSION['user_id'];
            $this->categoryModel->delete($id, $user_id);
            $_SESSION['flash_success'] = "Kategori berhasil dihapus!";
        }
        header("Location: /taskmaster/category");
        exit;
    }
}
?>