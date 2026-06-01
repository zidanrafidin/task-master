<?php
require_once 'app/controllers/Controller.php';
require_once 'app/models/TaskModel.php';
require_once 'app/models/CategoryModel.php'; // Butuh untuk opsi form

class TaskController extends Controller {
    private $taskModel;
    private $categoryModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/auth/login");
            exit;
        }
        $this->taskModel = new TaskModel();
        $this->categoryModel = new CategoryModel();
    }

// Tampilkan daftar task beserta Filter
    public function index() {
        $user_id = $_SESSION['user_id'];
        
        // Menangkap request filter dari URL (GET)
        $filters = [
            'search' => $_GET['search'] ?? '',
            'category_id' => $_GET['category_id'] ?? '',
            'priority' => $_GET['priority'] ?? '',
            'status' => $_GET['status'] ?? ''
        ];

        // Memanggil model dengan mengirimkan filter
        $tasks = $this->taskModel->getFilteredTasks($user_id, $filters);
        
        // Mengambil kategori untuk opsi di form filter
        $categories = $this->categoryModel->getAllByUserId($user_id);
        
        $this->view('tasks/index', [
            'title' => 'Manajemen Task - Task Master',
            'tasks' => $tasks,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    // Tampilkan form tambah dan proses insert
    public function create() {
        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $category_id = $_POST['category_id'];
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : null;
            $description = trim($_POST['description']);

            if (!empty($title) && !empty($category_id)) {
                $this->taskModel->create($user_id, $category_id, $title, $description, $priority, $status, $deadline);
                $_SESSION['flash_success'] = "Task baru berhasil ditambahkan!";
                header("Location: /taskmaster/task");
                exit;
            }
        }

        // Ambil data kategori untuk form dropdown
        $categories = $this->categoryModel->getAllByUserId($user_id);
        
        $this->view('tasks/create', [
            'title' => 'Tambah Task - Task Master',
            'categories' => $categories
        ]);
    }

    // Tampilkan form edit dan proses update
    public function edit($id = null) {
        if ($id === null) { header("Location: /taskmaster/task"); exit; }
        $user_id = $_SESSION['user_id'];
        
        $task = $this->taskModel->getById($id, $user_id);
        if (!$task) { header("Location: /taskmaster/task"); exit; }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $category_id = $_POST['category_id'];
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : null;
            $description = trim($_POST['description']);

            if (!empty($title)) {
                $this->taskModel->update($id, $user_id, $category_id, $title, $description, $priority, $status, $deadline);
                $_SESSION['flash_success'] = "Task berhasil diperbarui!";
                header("Location: /taskmaster/task");
                exit;
            }
        }

        $categories = $this->categoryModel->getAllByUserId($user_id);
        
        $this->view('tasks/edit', [
            'title' => 'Edit Task - Task Master',
            'task' => $task,
            'categories' => $categories
        ]);
    }

    public function delete($id = null) {
        if ($id !== null) {
            $user_id = $_SESSION['user_id'];
            $this->taskModel->delete($id, $user_id);
            $_SESSION['flash_success'] = "Task berhasil dihapus!";
        }
        header("Location: /taskmaster/task");
        exit;
    }
}
?>