<?php

class RatingModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($user_id, $game_id, $rating, $review) {
        // Check if user has already rated, if so, update. Otherwise, insert.
        if ($this->hasUserRated($user_id, $game_id)) {
            $stmt = $this->db->prepare("UPDATE rating SET Skor = ?, Ulasan = ?, TglRating = NOW() WHERE IDPengguna = ? AND IDGame = ?");
            return $stmt->execute([$rating, $review, $user_id, $game_id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO rating (IDPengguna, IDGame, Skor, Ulasan) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$user_id, $game_id, $rating, $review]);
        }
    }

    public function getAverageRating($game_id) {
        $stmt = $this->db->prepare("SELECT AVG(Skor) as average_rating FROM rating WHERE IDGame = ?");
        $stmt->execute([$game_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['average_rating'] : 0;
    }
    
    public function getRatingCount($game_id) {
        $stmt = $this->db->prepare("SELECT COUNT(IDRating) as count FROM rating WHERE IDGame = ?");
        $stmt->execute([$game_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['count'] : 0;
    }

    public function getReviews($game_id) {
        $stmt = $this->db->prepare("
            SELECT r.Skor, r.Ulasan, r.TglRating, p.Nama as NamaPengguna
            FROM rating r
            JOIN pengguna p ON r.IDPengguna = p.IDPengguna
            WHERE r.IDGame = ?
            ORDER BY r.TglRating DESC
        ");
        $stmt->execute([$game_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasUserRated($user_id, $game_id) {
        $stmt = $this->db->prepare("SELECT IDRating FROM rating WHERE IDPengguna = ? AND IDGame = ?");
        $stmt->execute([$user_id, $game_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUserRating($user_id, $game_id) {
        $stmt = $this->db->prepare("SELECT Skor, Ulasan FROM rating WHERE IDPengguna = ? AND IDGame = ?");
        $stmt->execute([$user_id, $game_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
