<?php

class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($user_id, $game_id, $amount) {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, game_id, amount) VALUES (?, ?, ?)");
        if ($stmt->execute([$user_id, $game_id, $amount])) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function findByUser($user_id) {
        $stmt = $this->db->prepare("
            SELECT o.id, o.order_date, o.amount, o.status, g.title AS game_title, g.image_url AS game_image
            FROM orders o
            JOIN games g ON o.game_id = g.id
            WHERE o.user_id = ?
            ORDER BY o.order_date DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAll() {
        $stmt = $this->db->query("
            SELECT o.id, o.order_date, o.amount, o.status, u.name AS user_name, g.title AS game_title
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN games g ON o.game_id = g.id
            ORDER BY o.order_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT o.id, o.order_date, o.amount, o.status, u.id AS user_id, u.name AS user_name, u.email AS user_email, g.id AS game_id, g.title AS game_title, g.price
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN games g ON o.game_id = g.id
            WHERE o.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
