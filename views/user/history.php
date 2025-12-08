<h1>My Order History</h1>

<?php if (isset($_GET['order_success'])): ?>
    <div class="alert alert-success">Your order was placed successfully!</div>
<?php endif; ?>

<?php if (empty($data['orders'])): ?>
    <p style="text-align: center;">You have not placed any orders yet. <a href="/">Browse games</a></p>
<?php else: ?>
    <div class="table-responsive">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Game</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order['id']) ?></td>
                        <td><?= date('d M Y, H:i', strtotime($order['order_date'])) ?></td>
                        <td>
                            <img src="/<?= htmlspecialchars($order['game_image']) ?>" alt="" style="width: 40px; border-radius: 4px; vertical-align: middle; margin-right: 10px;">
                            <?= htmlspecialchars($order['game_title']) ?>
                        </td>
                        <td>Rp. <?= number_format($order['amount']) ?></td>
                        <td><span class="status status-<?= htmlspecialchars($order['status']) ?>"><?= ucfirst(htmlspecialchars($order['status'])) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<style>
/* This is a temporary solution to style status, will be moved to main.css later if needed */
.status { padding: 5px 10px; border-radius: 15px; color: #fff; font-size: 0.8rem; text-transform: capitalize; }
.status-completed { background-color: var(--color-success); }
.status-pending { background-color: #ffc107; color: var(--color-bg); }
.status-cancelled { background-color: var(--color-danger); }
</style>
