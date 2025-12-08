<?php
// models/GameModel.php

class GameModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findAll() {
        $stmt = $this->db->query("
            SELECT g.*, p.NamaPlatform AS NamaPlatform 
            FROM game g
            JOIN platform p ON g.IDPlatform = p.IDPlatform
            ORDER BY g.Judul
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT g.*, p.NamaPlatform AS NamaPlatform 
            FROM game g
            JOIN platform p ON g.IDPlatform = p.IDPlatform
            WHERE g.IDGame = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $genre, $platform_id, $image_url) {
        $stmt = $this->db->prepare(
            "INSERT INTO game (Judul, Genre, IDPlatform, URLGambar) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $genre, $platform_id, $image_url]);
    }

    public function update($id, $title, $genre, $platform_id, $image_url) {
        $sql = "UPDATE game SET Judul = ?, Genre = ?, IDPlatform = ?";
        $params = [$title, $genre, $platform_id];

        if ($image_url) {
            $sql .= ", URLGambar = ?";
            $params[] = $image_url;
        }

        $sql .= " WHERE IDGame = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM game WHERE IDGame = ?");
        return $stmt->execute([$id]);
    }
    
    public function search($searchTerm) {
        $stmt = $this->db->prepare("
            SELECT g.*, p.NamaPlatform AS NamaPlatform 
            FROM game g 
            JOIN platform p ON g.IDPlatform = p.IDPlatform 
            WHERE g.Judul LIKE ? OR g.Genre LIKE ?
        ");
        $stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlatforms() {
        $stmt = $this->db->query("SELECT * FROM platform ORDER BY NamaPlatform");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}