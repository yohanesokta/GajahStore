<h1>All Rental Transactions</h1>

<div class="table-responsive">
    <table class="styled-table">
        <thead>
            <tr>
                <th>No. Nota</th>
                <th>Date</th>
                <th>User</th>
                <th>Items</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['rentals'])): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No rental transactions found in the system yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data['rentals'] as $rental): ?>
                    <tr>
                        <td style="font-family: monospace;">#<?= htmlspecialchars($rental['NomorNota']) ?></td>
                        <td><?= date('d M Y, H:i', strtotime($rental['TglTransaksi'])) ?></td>
                        <td><?= htmlspecialchars($rental['NamaPengguna']) ?></td>
                        <td><?= htmlspecialchars($rental['JumlahKaset']) ?> kaset</td>
                        <td><?= date('d M Y', strtotime($rental['TglWajibKembali'])) ?></td>
                        <td><span class="status status-<?= htmlspecialchars($rental['Status']) ?>"><?= ucfirst(htmlspecialchars($rental['Status'])) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
/* This is a temporary solution to style status, will be moved to main.css later if needed */
.status { padding: 5px 10px; border-radius: 15px; color: #fff; font-size: 0.8rem; text-transform: capitalize; }
.status-active { background-color: #007bff; }
.status-completed { background-color: var(--color-success); }
.status-pending { background-color: #ffc107; color: #333; }
.status-cancelled { background-color: var(--color-danger); }
</style>
