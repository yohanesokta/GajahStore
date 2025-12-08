<?php
// views/rental/confirm.php
$transaksi = $data['transaksi'];
$details = $data['details'];
?>
<div class="rental-container" style="text-align: center; max-width: 450px; margin: 2rem auto; padding: 2rem; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
    <h2 style="color: #333; margin-bottom: 1.5rem;">Konfirmasi Penyewaan</h2>
    <p style="color: #555; margin-bottom: 1.5rem;">Harap periksa detail penyewaan Anda dan lakukan konfirmasi.</p>
    
    <div class="rental-details" style="margin: 1.5rem 0; padding: 1rem; border-radius: 4px; border: 1px dashed #eee; background-color: #fcfcfc; text-align: left;">
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>No. Nota:</strong> <span style="font-family: monospace; color: #333;"><?= htmlspecialchars($transaksi['NomorNota']) ?></span></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Tgl. Sewa:</strong> <span style="color: #333;"><?= htmlspecialchars(date('d F Y', strtotime($transaksi['TglSewa']))) ?></span></p>
        <p style="margin-bottom: 1rem; color: #666;"><strong>Wajib Kembali:</strong> <span style="font-weight: bold; color: #d9534f;"><?= htmlspecialchars(date('d F Y', strtotime($transaksi['TglWajibKembali']))) ?></span></p>
        
        <strong style="color: #666;">Item Sewa:</strong>
        <ul style="list-style: none; padding-left: 0; margin-top: 0.5rem;">
            <?php foreach ($details as $item): ?>
                <li style="margin-bottom: 0.25rem;"><?= htmlspecialchars($item['Judul']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="qr-code" style="margin: 2rem 0;">
        <p style="color: #555;">Pindai kode QR ini untuk validasi di lokasi persewaan.</p>
        <img src="<?= htmlspecialchars($data['qr_code_url']) ?>" alt="QR Code untuk Konfirmasi Sewa" style="max-width: 100%; height: auto; border: 1px solid #eee; padding: 5px; border-radius: 5px;">
    </div>

    <p style="margin-top: 1.5rem; color: #555;">Dengan menekan tombol di bawah, Anda menyetujui syarat dan ketentuan sewa.</p>

    <form action="/payment/confirm/<?= htmlspecialchars($transaksi['NomorNota']) ?>" method="POST" style="margin-top: 1.5rem;">
        <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem; background-color: #007bff; border-color: #007bff; color: #fff; border-radius: 5px; cursor: pointer;">Konfirmasi dan Aktifkan Sewa</button>
    </form>
    
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red; margin-top: 1rem;">Aktivasi sewa gagal. Silakan coba lagi.</p>
    <?php endif; ?>
</div>
