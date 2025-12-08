<?php

class AdminModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDashboardStatistics() {
        $stats = [];

        // Get total users
        $stmt = $this->db->query("SELECT COUNT(IDPengguna) FROM pengguna");
        $stats['total_users'] = $stmt->fetchColumn();

        // Get total games
        $stmt = $this->db->query("SELECT COUNT(IDGame) FROM game");
        $stats['total_games'] = $stmt->fetchColumn();

        // Get total rental transactions
        $stmt = $this->db->query("SELECT COUNT(NomorNota) FROM transaksisewa");
        $stats['total_rentals'] = $stmt->fetchColumn();
        
        // Get active rentals
        $stmt = $this->db->query("SELECT COUNT(NomorNota) FROM transaksisewa WHERE Status = 'active'");
        $stats['active_rentals'] = $stmt->fetchColumn() ?? 0;

        // Get top rented games
        $stmt = $this->db->query("
            SELECT g.Judul, COUNT(ds.IDKaset) as rental_count
            FROM game g
            JOIN kaset k ON g.IDGame = k.IDGame
            JOIN detailsewa ds ON k.IDKaset = ds.IDKaset
            GROUP BY g.IDGame
            ORDER BY rental_count DESC
            LIMIT 5
        ");
        $stats['popular_games'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get highest rated games
        $stmt = $this->db->query("
            SELECT g.Judul, AVG(r.Skor) as avg_rating
            FROM game g
            JOIN rating r ON g.IDGame = r.IDGame
            GROUP BY g.IDGame
            ORDER BY avg_rating DESC
            LIMIT 5
        ");
        $stats['highest_rated_games'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }
}
