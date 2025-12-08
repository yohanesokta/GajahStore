<?php
// models/TransaksiModel.php

require_once 'KasetModel.php';

class TransaksiModel {
    private $db;
    private $kasetModel;

    public function __construct($db) {
        $this->db = $db;
        $this->kasetModel = new KasetModel($db);
    }

    /**
     * Membuat record transaksi sewa baru dengan status 'pending'.
     *
     * @param int $id_pengguna ID pengguna yang menyewa.
     * @param string $tgl_kembali Tanggal wajib kembali.
     * @param array $id_kasets Array dari ID kaset yang akan disewa.
     * @return string|false NomorNota jika berhasil, false jika gagal.
     */
    public function create($id_pengguna, $tgl_kembali, $id_kasets) {
        if (empty($id_kasets)) {
            return false;
        }

        $nomorNota = $this->generateNomorNota();
        $tglSewa = date('Y-m-d');

        $this->db->beginTransaction();

        try {
            // 1. Insert ke tabel master transaksi dengan status 'pending'
            $stmt = $this->db->prepare(
                "INSERT INTO transaksisewa (NomorNota, IDPengguna, TglSewa, TglWajibKembali, Status) VALUES (?, ?, ?, ?, 'pending')"
            );
            $stmt->execute([$nomorNota, $id_pengguna, $tglSewa, $tgl_kembali]);

            // 2. Insert ke tabel detail
            $detailStmt = $this->db->prepare(
                "INSERT INTO detailsewa (NomorNota, IDKaset) VALUES (?, ?)"
            );
            foreach ($id_kasets as $id_kaset) {
                $detailStmt->execute([$nomorNota, $id_kaset]);
            }

            $this->db->commit();
            return $nomorNota;
        } catch (Exception $e) {
            $this->db->rollBack();
            // Sebaiknya log error $e->getMessage()
            return false;
        }
    }
    
    /**
     * Mengaktifkan penyewaan: mengubah status transaksi menjadi 'active' dan kaset menjadi 'Disewa'.
     *
     * @param string $nomorNota
     * @return bool
     */
    public function activateRental($nomorNota) {
        $this->db->beginTransaction();
        try {
            // Update status transaksi
            $stmt = $this->db->prepare("UPDATE transaksisewa SET Status = 'active' WHERE NomorNota = ? AND Status = 'pending'");
            $stmt->execute([$nomorNota]);

            if ($stmt->rowCount() == 0) {
                // Transaksi tidak ditemukan atau statusnya bukan pending
                throw new Exception("Transaksi tidak valid untuk diaktifkan.");
            }

            // Dapatkan semua kaset dari transaksi ini
            $details = $this->findDetailsByNomorNota($nomorNota);
            if (empty($details)) {
                throw new Exception("Detail transaksi tidak ditemukan.");
            }

            // Update status setiap kaset
            foreach ($details as $detail) {
                $this->kasetModel->updateStatus($detail['IDKaset'], 'Disewa');
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            // Sebaiknya log error $e->getMessage()
            return false;
        }
    }

    /**
     * Mencari transaksi berdasarkan NomorNota.
     * @param string $nomorNota
     * @return mixed
     */
    public function findByNomorNota($nomorNota) {
        $stmt = $this->db->prepare("SELECT * FROM transaksisewa WHERE NomorNota = ?");
        $stmt->execute([$nomorNota]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Mencari semua transaksi milik seorang pengguna.
     *
     * @param int $user_id
     * @return array
     */
    public function findByUser($user_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM transaksisewa 
            WHERE IDPengguna = ?
            ORDER BY TglTransaksi DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mendapatkan semua detail kaset dari sebuah transaksi.
     *
     * @param string $nomorNota
     * @return array
     */
    public function findDetailsByNomorNota($nomorNota) {
        $stmt = $this->db->prepare("
            SELECT 
                k.IDKaset, 
                g.Judul, 
                g.URLGambar
            FROM detailsewa ds
            JOIN kaset k ON ds.IDKaset = k.IDKaset
            JOIN game g ON k.IDGame = g.IDGame
            WHERE ds.NomorNota = ?
        ");
        $stmt->execute([$nomorNota]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Mengambil semua transaksi untuk panel admin.
     */
    public function findAllForAdmin() {
        $stmt = $this->db->query("
            SELECT 
                ts.*, 
                p.Nama AS NamaPengguna,
                (SELECT COUNT(*) FROM detailsewa ds WHERE ds.NomorNota = ts.NomorNota) as JumlahKaset
            FROM transaksisewa ts
            JOIN pengguna p ON ts.IDPengguna = p.IDPengguna
            ORDER BY ts.TglTransaksi DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Generate Nomor Nota unik.
     * Contoh: RENT-20251209-ABC123
     */
    private function generateNomorNota() {
        $prefix = "RENT-";
        $datePart = date('Ymd');
        $randomPart = strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
        return $prefix . $datePart . '-' . $randomPart;
    }
}
