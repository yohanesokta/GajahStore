<?php
require_once 'base.php';
require_once 'models/AdminModel.php';
require_once 'models/GameModel.php';
require_once 'models/UserModel.php';
require_once 'models/OrderModel.php';

class AdminController extends BaseController {

    public function __construct($db) {
        parent::__construct($db);
        $this->requireAdmin();
    }

    public function index() {
        $adminModel = new AdminModel($this->db);
        $stats = $adminModel->getDashboardStatistics();
        $this->view('admin/dashboard', ['title' => 'Admin Dashboard', 'stats' => $stats]);
    }

    public function games() {
        $gameModel = new GameModel($this->db);
        $games = $gameModel->findAll();
        $this->view('admin/manage_games', ['title' => 'Manage Games', 'games' => $games]);
    }

    public function users() {
        $userModel = new UserModel($this->db);
        $users = $userModel->findAll();
        $this->view('admin/manage_users', ['title' => 'Manage Users', 'users' => $users]);
    }
    
    public function orders() {
        $orderModel = new OrderModel($this->db);
        $orders = $orderModel->findAll();
        $this->view('admin/manage_orders', ['title' => 'Manage Orders', 'orders' => $orders]);
    }

    public function editGame($id = null) {
        $gameModel = new GameModel($this->db);
        $platforms = $gameModel->getPlatforms();
        $game = null;
        $title = 'Add New Game';

        if ($id) {
            $game = $gameModel->findById($id);
            $title = 'Edit Game';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title_post = $_POST['title'] ?? '';
            $genre = $_POST['genre'] ?? '';
            $platform_id = $_POST['platform_id'] ?? 0;
            // Harga sekarang adalah integer, mata uang ditambahkan
            $price = (int)($_POST['price'] ?? 0);
            $currency = $_POST['currency'] ?? 'USD';
            
            $image_url = $game['image_url'] ?? null;

            // Logika upload file
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/images/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $safe_filename = uniqid() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $safe_filename;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $target_file;
                }
            }

            if ($id) { // Update game
                $gameModel->update($id, $title_post, $genre, $platform_id, $price, $currency, $image_url);
            } else { // Buat game baru
                $gameModel->create($title_post, $genre, $platform_id, $price, $currency, $image_url);
            }
            $this->redirect('/admin/games');
        }

        $this->view('admin/edit_game', [
            'title' => $title,
            'game' => $game,
            'platforms' => $platforms
        ]);
    }
    
    /**
     * Menampilkan halaman laporan game terlaris.
     */
    public function topSelling() {
        $gameModel = new GameModel($this->db);
        $topGames = $gameModel->topSelling(5); // Ambil top 5

        $this->view('admin/report_top_selling', [
            'title' => 'Top 5 Selling Games',
            'topGames' => $topGames
        ]);
    }
    
    public function deleteGame($id) {
        $gameModel = new GameModel($this->db);
        $gameModel->delete($id);
        $this->redirect('/admin/games');
    }

    public function editUser($id = null) {
        $userModel = new UserModel($this->db);
        $user = null;
        $title = 'Add New User';

        if ($id) {
            $user = $userModel->findById($id);
            $title = 'Edit User';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $password = $_POST['password'] ?? '';

            if ($id) { // Update
                $userModel->update($id, $name, $email, $role);
                // Password change is handled separately or requires confirmation
            } else { // Create
                if(!empty($password)){
                    $userModel->register($name, $email, $password);
                }
            }
            $this->redirect('/admin/users');
        }
        
        $this->view('admin/edit_user', [
            'title' => $title,
            'user' => $user
        ]);
    }
    
    public function deleteUser($id) {
        // Prevent admin from deleting themselves
        if ($id == $_SESSION['user_id']) {
            $this->redirect('/admin/users?error=self_delete');
        }
        $userModel = new UserModel($this->db);
        $userModel->delete($id);
        $this->redirect('/admin/users');
    }
}
