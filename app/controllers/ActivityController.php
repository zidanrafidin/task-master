<?php
require_once 'app/controllers/Controller.php';
require_once 'app/models/ActivityModel.php';

class ActivityController extends Controller {
    private $activityModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /taskmaster/auth/login");
            exit;
        }
        $this->activityModel = new ActivityModel();
    }

    public function index() {
        $user_id = $_SESSION['user_id'];
        
        // Ambil 50 aktivitas terakhir
        $activities = $this->activityModel->getRecentActivities($user_id);

        $this->view('activity/index', [
            'title' => 'Riwayat Aktivitas - Task Master',
            'activities' => $activities
        ]);
    }
}
?>