<h1>All User Orders</h1>

<div class="table-responsive">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>User</th>
                <th>Game</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['orders'])): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No orders found in the system yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order['id']) ?></td>
                        <td><?= date('d M Y, H:i', strtotime($order['updated_at'])) ?></td>
                        <td><?= htmlspecialchars($order['user_name']) ?></td>
                        <td><?= htmlspecialchars($order['game_title']) ?></td>
                        <td>Rp. <?= number_format($order['amount']) ?></td>
                        <td><span class="status status-<?= htmlspecialchars($order['status']) ?>"><?= ucfirst(htmlspecialchars($order['status'])) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
/* This is a temporary solution to style status, will be moved to main.css later if needed */
.status { padding: 5px 10px; border-radius: 15px; color: #fff; font-size: 0.8rem; text-transform: capitalize; }
.status-completed { background-color: var(--color-success); }
.status-pending { background-color: #ffc107; color: var(--color-bg); }
.status-cancelled { background-color: var(--color-danger); }
</style>
