<?php
require_once 'app/controllers/Controller.php';
require_once 'app/models/DashboardModel.php'; // Panggil model baru

class DashboardController extends Controller {
    private $dashboardModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/auth/login");
            exit;
        }
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {
        $user_id = $_SESSION['user_id'];
        
        // Ambil data statistik dari Model
        $total_tasks = $this->dashboardModel->countTotalTasks($user_id);
        $completed_tasks = $this->dashboardModel->countTasksByStatus($user_id, 'Done');
        $in_progress_tasks = $this->dashboardModel->countTasksByStatus($user_id, 'In Progress');
        $total_categories = $this->dashboardModel->countTotalCategories($user_id);
        
        // Ambil data task terbaru
        $recent_tasks = $this->dashboardModel->getRecentTasks($user_id, 5);

        // Kirim semua data ke View
        $data = [
            'title' => 'Dashboard - Task Master',
            'user_name' => $_SESSION['user_name'],
            'stats' => [
                'total' => $total_tasks,
                'done' => $completed_tasks,
                'progress' => $in_progress_tasks,
                'categories' => $total_categories
            ],
            'recent_tasks' => $recent_tasks
        ];
        
        $this->view('dashboard/index', $data);
    }
}
?>