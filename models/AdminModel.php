<?php

class AdminModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDashboardStatistics() {
        $stats = [];

        // Get total users
        $stmt = $this->db->query("SELECT COUNT(id) FROM users");
        $stats['total_users'] = $stmt->fetchColumn();

        // Get total games
        $stmt = $this->db->query("SELECT COUNT(id) FROM games");
        $stats['total_games'] = $stmt->fetchColumn();

        // Get total orders
        $stmt = $this->db->query("SELECT COUNT(id) FROM orders");
        $stats['total_orders'] = $stmt->fetchColumn();
        
        // Get total revenue
        $stmt = $this->db->query("SELECT SUM(amount) FROM orders WHERE status = 'completed'");
        $stats['total_revenue'] = $stmt->fetchColumn() ?? 0;

        // Get popular games (by number of orders)
        $stmt = $this->db->query("
            SELECT g.title, COUNT(o.id) as order_count
            FROM games g
            JOIN orders o ON g.id = o.game_id
            GROUP BY g.id
            ORDER BY order_count DESC
            LIMIT 5
        ");
        $stats['popular_games'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get highest rated games
        $stmt = $this->db->query("
            SELECT g.title, AVG(r.rating) as avg_rating
            FROM games g
            JOIN ratings r ON g.id = r.game_id
            GROUP BY g.id
            ORDER BY avg_rating DESC
            LIMIT 5
        ");
        $stats['highest_rated_games'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }
}
