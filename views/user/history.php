<h1>Riwayat Sewa Saya</h1>

<?php if (isset($_GET['rental_success'])): ?>
    <div class="alert alert-success">Transaksi sewa Anda berhasil!</div>
<?php endif; ?>

<?php if (empty($data['transaksi'])): ?>
    <p style="text-align: center;">Anda belum pernah melakukan penyewaan. <a href="/">Lihat-lihat game</a></p>
<?php else: ?>
    <div class="table-responsive">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>No. Nota</th>
                    <th>Tgl. Sewa</th>
                    <th>Wajib Kembali</th>
                    <th>Item Sewa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['transaksi'] as $tx): ?>
                    <tr>
                        <td style="font-family: monospace;">#<?= htmlspecialchars($tx['NomorNota'])?></td>
                        <td><?= date('d M Y', strtotime($tx['TglSewa'])) ?></td>
                        <td><?= date('d M Y', strtotime($tx['TglWajibKembali'])) ?></td>
                        <td>
                            <?php if (empty($tx['details'])): ?>
                                <span>-</span>
                            <?php else: ?>
                                <ul style="margin: 0; padding-left: 20px;">
                                    <?php foreach($tx['details'] as $item): ?>
                                        <li><?= htmlspecialchars($item['Judul']) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="status status-<?= htmlspecialchars($tx['Status']) ?>"><?= ucfirst(htmlspecialchars($tx['Status'])) ?></span>
                            <?php if ($tx['Status'] == 'pending') { ?>
                                <a style="background-color:green; color:white; padding:5px 10px; border-radius:20px; font-size:11pt; text-decoration: none; margin-left: 5px;" href="/payment/simulate/<?= $tx['NomorNota']?>">Konfirmasi</a>    
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<style>
/* This is a temporary solution to style status, will be moved to main.css later if needed */
.status { padding: 5px 10px; border-radius: 15px; color: #fff; font-size: 0.8rem; text-transform: capitalize; }
.status-active { background-color: #007bff; }
.status-completed { background-color: var(--color-success); }
.status-pending { background-color: #ffc107; color: #333; }
.status-cancelled { background-color: var(--color-danger); }
</style>
