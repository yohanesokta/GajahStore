<?php
// views/rental/success.php
$transaksi = $data['transaksi'];
?>
<div class="rental-success-container" style="text-align: center; max-width: 500px; margin: 2rem auto; padding: 2rem; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
    <div style="font-size: 4rem; color: #28a745; margin-bottom: 1rem;">&#10004;</div>
    <h2 style="margin-top: 1rem; color: #333;">Penyewaan Berhasil!</h2>
    <p style="color: #555;">Transaksi sewa Anda telah berhasil diaktifkan.</p>

    <div class="receipt" style="margin: 2rem 0; text-align: left; background: #f9f9f9; padding: 1.5rem; border: 1px dashed #eee; border-radius: 4px;">
        <h3 style="margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; color: #333;">Ringkasan Sewa</h3>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>No. Nota:</strong> <span style="font-family: monospace; color: #333;"><?= htmlspecialchars($transaksi['NomorNota']) ?></span></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Tanggal Sewa:</strong> <?= htmlspecialchars(date('d F Y', strtotime($transaksi['TglSewa']))) ?></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Wajib Kembali:</strong> <span style="font-weight: bold; color: #d9534f;"><?= htmlspecialchars(date('d F Y', strtotime($transaksi['TglWajibKembali']))) ?></span></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Status:</strong> <span style="font-weight: bold; color: #28a745;"><?= htmlspecialchars(ucfirst($transaksi['Status'])) ?></span></p>
    </div>

    <p>Anda dapat melihat detail penyewaan ini di riwayat transaksi Anda.</p>
    <a href="/history" class="btn" style="display: inline-block; margin-top: 1.5rem; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Lihat Riwayat Sewa</a>
</div>
