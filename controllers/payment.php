<?php
// controllers/PaymentController.php

require_once 'base.php';
require_once 'models/OrderModel.php';

class PaymentController extends BaseController {

    public function __construct($db) {
        parent::__construct($db);
        // Memastikan hanya user yang sudah login yang bisa mengakses halaman pembayaran
        $this->requireLogin();
    }

    /**
     * Menampilkan halaman simulasi pembayaran untuk order tertentu.
     *
     * @param string $order_uid
     */
    public function simulate($order_uid) {
        $orderModel = new OrderModel($this->db);
        $order = $orderModel->findByUid($order_uid);

        // Validasi: order harus ada, milik user yang login, dan statusnya 'pending'
        if (!$order || $order['user_id'] != $_SESSION['user_id'] || $order['status'] != 'pending') {
            $this->redirect('/history');
            return;
        }

        // Membuat URL untuk gambar QR placeholder dari layanan eksternal
        $qr_data = "order_id:{$order['order_uid']},amount:{$order['amount']}{$order['currency']}";
        $qr_code_url = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($qr_data);

        $this->view('payment/qris_simulate', [
            'title' => 'Simulasi Pembayaran',
            'order' => $order,
            'qr_code_url' => $qr_code_url
        ]);
    }

    /**
     * Memproses konfirmasi pembayaran yang disimulasikan.
     *
     * @param string $order_uid
     */
    public function confirm($order_uid) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
            return;
        }

        $orderModel = new OrderModel($this->db);
        $order = $orderModel->findByUid($order_uid);

        // Validasi ulang sebelum mengubah status
        if (!$order || $order['user_id'] != $_SESSION['user_id'] || $order['status'] != 'pending') {
            $this->redirect('/history');
            return;
        }

        // Ubah status order menjadi 'paid'
        $updated = $orderModel->updatePaymentStatus($order_uid, 'paid', 'qris_simulation');

        if ($updated) {
            // Logika tambahan bisa ditambahkan di sini, misalnya:
            // - Menambahkan game ke library user
            // - Menambah saldo dompet digital user jika ini adalah top-up
            
            // Arahkan ke halaman sukses
            $this->redirect('/payment/success/' . $order_uid);
        } else {
            // Arahkan kembali dengan pesan error jika update gagal
            $this->redirect('/payment/simulate/' . $order_uid . '?error=payment_failed');
        }
    }

    /**
     * Menampilkan halaman sukses setelah pembayaran berhasil.
     *
     * @param string $order_uid
     */
    public function success($order_uid) {
        $orderModel = new OrderModel($this->db);
        $order = $orderModel->findByUid($order_uid);

        // Validasi: pastikan user hanya melihat order miliknya
        if (!$order || $order['user_id'] != $_SESSION['user_id']) {
            $this->redirect('/history');
            return;
        }

        $this->view('payment/payment_success', [
            'title' => 'Pembayaran Berhasil',
            'order' => $order
        ]);
    }
}
