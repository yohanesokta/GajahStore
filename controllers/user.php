<?php
require_once 'base.php';
require_once 'models/GameModel.php';
require_once 'models/OrderModel.php';
require_once 'models/RatingModel.php';

class UserController extends BaseController {

    public function __construct($db) {
        parent::__construct($db);
        $this->requireLogin();
    }

    public function index() {
        $gameModel = new GameModel($this->db);
        $searchTerm = $_GET['search'] ?? '';

        if (!empty($searchTerm)) {
            $games = $gameModel->search($searchTerm);
        } else {
            $games = $gameModel->findAll();
        }
        
        $this->view('home', ['title' => 'Home', 'games' => $games, 'searchTerm' => $searchTerm]);
    }

    public function history() {
        $orderModel = new OrderModel($this->db);
        $orders = $orderModel->findByUser($_SESSION['user_id']);
        $this->view('user/history', ['title' => 'Order History', 'orders' => $orders]);
    }

    public function show($id) {
        $gameModel = new GameModel($this->db);
        $ratingModel = new RatingModel($this->db);

        $game = $gameModel->findById($id);
        if (!$game) {
            $this->redirect('/'); // Or show a 404 page
        }

        $avgRating = $ratingModel->getAverageRating($id);
        $ratingCount = $ratingModel->getRatingCount($id);
        $reviews = $ratingModel->getReviews($id);
        $userRating = $ratingModel->getUserRating($_SESSION['user_id'], $id);

        $this->view('user/show_game', [
            'title' => $game['title'],
            'game' => $game,
            'avgRating' => $avgRating,
            'ratingCount' => $ratingCount,
            'reviews' => $reviews,
            'userRating' => $userRating
        ]);
    }

    public function order($game_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gameModel = new GameModel($this->db);
            $game = $gameModel->findById($game_id);

            if (!$game) {
                $this->redirect('/');
            }

            $amount = $_POST['amount'] ?? $game['price'];

            $orderModel = new OrderModel($this->db);
            $orderId = $orderModel->create($_SESSION['user_id'], $game_id, $amount);

            if ($orderId) {
                // Simulate payment and completion
                $orderModel->updateStatus($orderId, 'completed');
                $this->redirect('/history?order_success=true');
            } else {
                $this->redirect('/game/' . $game_id . '?error=order_failed');
            }
        } else {
             $this->redirect('/');
        }
    }

    public function rate($game_id) {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'] ?? null;
            $review = $_POST['review'] ?? '';

            if ($rating) {
                $ratingModel = new RatingModel($this->db);
                $ratingModel->create($_SESSION['user_id'], $game_id, $rating, $review);
                $this->redirect('/game/' . $game_id . '?rated=true');
            } else {
                $this->redirect('/game/' . $game_id . '?error=rating_missing');
            }
        } else {
            $this->redirect('/game/' . $game_id);
        }
    }
}
