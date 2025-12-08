<?php

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

    public function create($title, $genre, $platform_id, $price, $image_url) {
        $stmt = $this->db->prepare("INSERT INTO games (title, genre, platform_id, price, image_url) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $genre, $platform_id, $price, $image_url]);
    }

    public function update($id, $title, $genre, $platform_id, $price, $image_url) {
        $sql = "UPDATE games SET title = ?, genre = ?, platform_id = ?, price = ?";
        $params = [$title, $genre, $platform_id, $price];

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
}
