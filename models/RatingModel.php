<?php

class RatingModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($user_id, $game_id, $rating, $review) {
        // Check if user has already rated, if so, update. Otherwise, insert.
        if ($this->hasUserRated($user_id, $game_id)) {
            $stmt = $this->db->prepare("UPDATE ratings SET rating = ?, review = ?, created_at = NOW() WHERE user_id = ? AND game_id = ?");
            return $stmt->execute([$rating, $review, $user_id, $game_id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO ratings (user_id, game_id, rating, review) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$user_id, $game_id, $rating, $review]);
        }
    }

    public function getAverageRating($game_id) {
        $stmt = $this->db->prepare("SELECT AVG(rating) as average_rating FROM ratings WHERE game_id = ?");
        $stmt->execute([$game_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? round($result['average_rating'], 1) : 0;
    }
    
    public function getRatingCount($game_id) {
        $stmt = $this->db->prepare("SELECT COUNT(id) as count FROM ratings WHERE game_id = ?");
        $stmt->execute([$game_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['count'] : 0;
    }

    public function getReviews($game_id) {
        $stmt = $this->db->prepare("
            SELECT r.rating, r.review, r.created_at, u.name as user_name
            FROM ratings r
            JOIN users u ON r.user_id = u.id
            WHERE r.game_id = ?
            ORDER BY r.created_at DESC
        ");
        $stmt->execute([$game_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasUserRated($user_id, $game_id) {
        $stmt = $this->db->prepare("SELECT id FROM ratings WHERE user_id = ? AND game_id = ?");
        $stmt->execute([$user_id, $game_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUserRating($user_id, $game_id) {
        $stmt = $this->db->prepare("SELECT rating, review FROM ratings WHERE user_id = ? AND game_id = ?");
        $stmt->execute([$user_id, $game_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
