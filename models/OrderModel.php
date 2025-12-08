<?php
// models/OrderModel.php

class OrderModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Membuat order baru (untuk pembelian game atau top-up).
     *
     * @param int $user_id
     * @param int $amount Jumlah dalam unit terkecil.
     * @param string $currency
     * @param string $type Tipe order: 'game_purchase' or 'top_up'.
     * @param int|null $game_id ID game jika tipenya 'game_purchase'.
     * @return string|false UID order yang unik atau false jika gagal.
     */
    public function create($user_id, $amount, $currency, $type = 'game_purchase', $game_id = null) {
        // Membuat ID unik untuk order yang lebih aman daripada auto-increment ID
        $order_uid = 'ORD-' . strtoupper(bin2hex(random_bytes(8)));
        
        $sql = "INSERT INTO orders (order_uid, user_id, game_id, amount, currency, type, status) 
                VALUES (?, ?, ?, ?, ?, ?, 'pending')";
        
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute([$order_uid, $user_id, $game_id, $amount, $currency, $type])) {
            return $order_uid;
        }
        
        return false;
    }

    /**
     * Mencari order berdasarkan UID uniknya.
     *
     * @param string $order_uid
     * @return mixed Data order atau false jika tidak ditemukan.
     */
    public function findByUid($order_uid) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE order_uid = ?");
        $stmt->execute([$order_uid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Mencari semua order milik seorang user.
     *
     * @param int $user_id
     * @return array
     */
    public function findByUser($user_id) {
        $stmt = $this->db->prepare("
            SELECT 
                o.order_uid, 
                o.created_at as order_date, 
                o.amount, 
                o.currency,
                o.status, 
                o.type,
                g.title AS game_title, 
                g.image_url AS game_image
            FROM orders o
            LEFT JOIN games g ON o.game_id = g.id AND o.type = 'game_purchase'
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Memperbarui status pembayaran dan metode pembayaran berdasarkan UID.
     *
     * @param string $order_uid
     * @param string $status Status baru ('paid', 'cancelled').
     * @param string|null $payment_method
     * @return bool
     */
    public function updatePaymentStatus($order_uid, $status, $payment_method = null) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ?, payment_method = ? WHERE order_uid = ?");
        return $stmt->execute([$status, $payment_method, $order_uid]);
    }

    /**
     * Mengambil semua order untuk panel admin.
     *
     * @return array
     */
    public function findAll() {
        $stmt = $this->db->query("
            SELECT 
                o.*, 
                u.name AS user_name, 
                g.title AS game_title
            FROM orders o
            JOIN users u ON o.user_id = u.id
            LEFT JOIN games g ON o.game_id = g.id AND o.type = 'game_purchase'
            ORDER BY o.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}