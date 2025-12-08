<?php
// controllers/PaymentController.php

require_once 'base.php';
require_once 'models/TransaksiModel.php';

class PaymentController extends BaseController {

    public function __construct($db) {
        parent::__construct($db);
        $this->requireLogin();
    }

    /**
     * Menampilkan halaman simulasi konfirmasi sewa untuk transaksi tertentu.
     *
     * @param string $nomorNota
     */
    public function simulate($nomorNota) {
        $transaksiModel = new TransaksiModel($this->db);
        $transaksi = $transaksiModel->findByNomorNota($nomorNota);

        // Validasi: transaksi harus ada, milik user yang login, dan statusnya 'pending'
        if (!$transaksi || $transaksi['IDPengguna'] != $_SESSION['user_id'] || $transaksi['Status'] != 'pending') {
            $this->redirect('/history');
            return;
        }
        
        $details = $transaksiModel->findDetailsByNomorNota($nomorNota);

        // Membuat URL untuk gambar QR placeholder
        $qr_data = "nomor_nota:{$transaksi['NomorNota']},user_id:{$transaksi['IDPengguna']}";
        $qr_code_url = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($qr_data);

        // Mengganti nama view ke `rental/confirm`
        $this->view('rental/confirm', [
            'title' => 'Konfirmasi Penyewaan',
            'transaksi' => $transaksi,
            'details' => $details,
            'qr_code_url' => $qr_code_url
        ]);
    }

    /**
     * Memproses konfirmasi sewa yang disimulasikan.
     *
     * @param string $nomorNota
     */
    public function confirm($nomorNota) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
            return;
        }

        $transaksiModel = new TransaksiModel($this->db);
        $transaksi = $transaksiModel->findByNomorNota($nomorNota);

        // Validasi ulang sebelum mengubah status
        if (!$transaksi || $transaksi['IDPengguna'] != $_SESSION['user_id'] || $transaksi['Status'] != 'pending') {
            $this->redirect('/history');
            return;
        }

        // Aktifkan rental: status transaksi -> 'active', status kaset -> 'Disewa'
        $updated = $transaksiModel->activateRental($nomorNota);

        if ($updated) {
            // Arahkan ke halaman sukses
            $this->redirect('/payment/success/' . $nomorNota);
        } else {
            // Arahkan kembali dengan pesan error jika update gagal
            $this->redirect('/payment/simulate/' . $nomorNota . '?error=activation_failed');
        }
    }

    /**
     * Menampilkan halaman sukses setelah sewa berhasil.
     *
     * @param string $nomorNota
     */
    public function success($nomorNota) {
        $transaksiModel = new TransaksiModel($this->db);
        $transaksi = $transaksiModel->findByNomorNota($nomorNota);

        // Validasi: pastikan user hanya melihat transaksi miliknya
        if (!$transaksi || $transaksi['IDPengguna'] != $_SESSION['user_id']) {
            $this->redirect('/history');
            return;
        }

        // Mengganti nama view ke `rental/success`
        $this->view('rental/success', [
            'title' => 'Penyewaan Berhasil',
            'transaksi' => $transaksi
        ]);
    }
}
