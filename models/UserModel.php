<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO pengguna (Nama, Email, Password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword]);
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT IDPengguna, Nama, Role , Password FROM pengguna WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }
        return false;
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pengguna WHERE IDPengguna = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT IDPengguna, Nama, Email, Role FROM pengguna");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function update($id, $name, $email, $role) {
        $stmt = $this->db->prepare("UPDATE pengguna SET Nama = ?, Email = ?, Role = ? WHERE IDPengguna = ?");
        return $stmt->execute([$name, $email, $role, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pengguna WHERE IDPengguna = ?");
        return $stmt->execute([$id]);
    }

    public function isEmailTaken($email, $excludeId = null) {
        $sql = "SELECT IDPengguna FROM pengguna WHERE Email = ?";
        $params = [$email];
        if ($excludeId) {
            $sql .= " AND IDPengguna != ?";
            $params[] = $excludeId;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }
}
