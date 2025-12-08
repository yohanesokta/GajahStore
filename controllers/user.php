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
        // This method now INITIATES a game purchase order
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gameModel = new GameModel($this->db);
            $game = $gameModel->findById($game_id);

            if (!$game) {
                $this->redirect('/'); // Game not found
                return;
            }

            $orderModel = new OrderModel($this->db);
            // Create a new order for this specific game
            $order_uid = $orderModel->create(
                $_SESSION['user_id'],
                $game['price'],      // Amount from the game record
                $game['currency'],   // Currency from the game record
                'game_purchase',     // Type of order
                $game['id']          // The game being purchased
            );

            if ($order_uid) {
                // Redirect user to the payment simulation page
                $this->redirect('/payment/simulate/' . $order_uid);
            } else {
                // Redirect back to the game page with an error
                $this->redirect('/game/' . $game_id . '?error=order_creation_failed');
            }
        } else {
            // Only POST method is allowed to create an order
             $this->redirect('/game/' . $game_id);
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
