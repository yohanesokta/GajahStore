<?php
// models/KasetModel.php

class KasetModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Menemukan satu kaset yang tersedia untuk IDGame tertentu.
     * @param int $game_id
     * @return mixed Kaset data or false if not found.
     */
    public function findAvailableByGameId($game_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM kaset 
            WHERE IDGame = ? AND Status = 'Tersedia' 
            LIMIT 1
        ");
        $stmt->execute([$game_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Memperbarui status kaset.
     * @param int $kaset_id
     * @param string $status
     * @return bool
     */
    public function updateStatus($kaset_id, $status) {
        $stmt = $this->db->prepare("UPDATE kaset SET Status = ? WHERE IDKaset = ?");
        return $stmt->execute([$status, $kaset_id]);
    }
    
    /**
     * Menghitung jumlah stok yang tersedia untuk sebuah game.
     * @param int $game_id
     * @return int
     */
    public function countStockByGameId($game_id) {
        $stmt = $this->db->prepare("SELECT COUNT(IDKaset) as stock FROM kaset WHERE IDGame = ? AND Status = 'Tersedia'");
        $stmt->execute([$game_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['stock'] : 0;
    }

    /**
     * Menambahkan stok kaset baru untuk sebuah game.
     * @param int $game_id
     * @param int $quantity
     * @return bool
     */
    public function addStock($game_id, $quantity) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("INSERT INTO kaset (IDGame) VALUES (?)");
            for ($i = 0; $i < $quantity; $i++) {
                if (!$stmt->execute([$game_id])) {
                    throw new Exception("Gagal menambahkan stok kaset.");
                }
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            // Log error message e->getMessage()
            return false;
        }
    }

    /**
     * Mengambil semua kaset untuk sebuah game (untuk admin).
     * @param int $game_id
     * @return array
     */
    public function findAllByGameId($game_id) {
        $stmt = $this->db->prepare("SELECT * FROM kaset WHERE IDGame = ? ORDER BY IDKaset");
        $stmt->execute([$game_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Menghapus stok kaset.
     * @param int $kaset_id
     * @return bool
     */
    public function delete($kaset_id) {
        $stmt = $this->db->prepare("DELETE FROM kaset WHERE IDKaset = ?");
        return $stmt->execute([$kaset_id]);
    }
}
