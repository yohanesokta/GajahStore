<?php
// models/GameModel.php

class GameModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findAll() {
        $stmt = $this->db->query("
            SELECT g.*, p.name AS platform_name 
            FROM games g
            JOIN platforms p ON g.platform_id = p.id
            ORDER BY g.title
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT g.*, p.name AS platform_name 
            FROM games g
            JOIN platforms p ON g.platform_id = p.id
            WHERE g.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $genre, $platform_id, $price, $currency, $image_url) {
        $stmt = $this->db->prepare(
            "INSERT INTO games (title, genre, platform_id, price, currency, image_url) VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $genre, $platform_id, $price, $currency, $image_url]);
    }

    public function update($id, $title, $genre, $platform_id, $price, $currency, $image_url) {
        $sql = "UPDATE games SET title = ?, genre = ?, platform_id = ?, price = ?, currency = ?";
        $params = [$title, $genre, $platform_id, $price, $currency];

        if ($image_url) {
            $sql .= ", image_url = ?";
            $params[] = $image_url;
        }

        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM games WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function search($searchTerm) {
        $stmt = $this->db->prepare("
            SELECT g.*, p.name AS platform_name 
            FROM games g 
            JOIN platforms p ON g.platform_id = p.id 
            WHERE g.title LIKE ? OR g.genre LIKE ?
        ");
        $stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlatforms() {
        $stmt = $this->db->query("SELECT * FROM platforms ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil daftar game yang paling banyak terjual.
     *
     * @param int $limit Jumlah game teratas yang ingin ditampilkan.
     * @return array
     */
    public function topSelling($limit = 5) {
        $stmt = $this->db->prepare("
            SELECT 
                g.id, 
                g.title, 
                g.image_url,
                COUNT(o.game_id) as total_sales
            FROM orders o
            JOIN games g ON o.game_id = g.id
            WHERE o.status = 'paid' AND o.type = 'game_purchase'
            GROUP BY o.game_id
            ORDER BY total_sales DESC
            LIMIT :limit
        ");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}