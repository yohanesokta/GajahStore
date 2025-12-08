<?php
require_once 'base.php';
require_once 'models/GameModel.php';
require_once 'models/TransaksiModel.php';
require_once 'models/KasetModel.php';
require_once 'models/RatingModel.php';

class UserController extends BaseController {

    public function __construct($db) {
        parent::__construct($db);
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
        $this->requireLogin();
        $transaksiModel = new TransaksiModel($this->db);
        $transaksi = $transaksiModel->findByUser($_SESSION['user_id']);
        
        // Untuk setiap transaksi, ambil detail itemnya
        foreach ($transaksi as $key => $t) {
            $transaksi[$key]['details'] = $transaksiModel->findDetailsByNomorNota($t['NomorNota']);
        }

        $this->view('user/history', ['title' => 'Riwayat Sewa', 'transaksi' => $transaksi]);
    }

    public function show($id) {
        $gameModel = new GameModel($this->db);
        $ratingModel = new RatingModel($this->db);
        $kasetModel = new KasetModel($this->db);

        $game = $gameModel->findById($id);
        if (!$game) {
            $this->redirect('/'); // Or show a 404 page
        }
        
        // Ambil data rating
        $avgRating = $ratingModel->getAverageRating($id);
        $ratingCount = $ratingModel->getRatingCount($id);
        $reviews = $ratingModel->getReviews($id);
        
        // Ambil rating dari user yang sedang login
        $userRating = null;
        if($this->isLoggedIn()){
            $userRating = $ratingModel->getUserRating($_SESSION['user_id'], $id);
        }

        // Ambil jumlah stok yang tersedia
        $stockCount = $kasetModel->countStockByGameId($id);

        $this->view('user/show_game', [
            'title' => $game['Judul'],
            'game' => $game,
            'avgRating' => $avgRating,
            'ratingCount' => $ratingCount,
            'reviews' => $reviews,
            'userRating' => $userRating,
            'stockCount' => $stockCount
        ]);
    }

    public function rent($game_id) {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             $this->redirect('/game/' . $game_id);
             return;
        }

        $kasetModel = new KasetModel($this->db);
        $transaksiModel = new TransaksiModel($this->db);
        
        // 1. Cari satu kaset yang tersedia untuk game ini
        $availableKaset = $kasetModel->findAvailableByGameId($game_id);

        if (!$availableKaset) {
            $this->redirect('/game/' . $game_id . '?error=no_stock');
            return;
        }

        // 2. Buat transaksi sewa dengan status 'pending'
        $id_pengguna = $_SESSION['user_id'];
        $id_kasets = [$availableKaset['IDKaset']]; // Sewa satu kaset
        $tgl_kembali = date('Y-m-d', strtotime('+7 days')); // Durasi sewa 7 hari

        $nomorNota = $transaksiModel->create($id_pengguna, $tgl_kembali, $id_kasets);

        if ($nomorNota) {
            // 3. Arahkan user ke halaman konfirmasi
            $this->redirect('/payment/simulate/' . $nomorNota);
        } else {
            // Redirect kembali jika pembuatan transaksi gagal
            $this->redirect('/game/' . $game_id . '?error=rental_creation_failed');
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
