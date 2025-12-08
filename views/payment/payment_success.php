<?php
// views/payment/payment_success.php
require_once 'lib/helper.php';
$order = $data['order'];
?>
<div class="payment-success-container" style="text-align: center; max-width: 500px; margin: 2rem auto; padding: 2rem; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
    <div style="font-size: 4rem; color: #28a745; margin-bottom: 1rem;">&#10004;</div>
    <h2 style="margin-top: 1rem; color: #333;">Payment Successful!</h2>
    <p style="color: #555;">Your transaction has been completed successfully.</p>

    <div class="receipt" style="margin: 2rem 0; text-align: left; background: #f9f9f9; padding: 1.5rem; border: 1px dashed #eee; border-radius: 4px;">
        <h3 style="margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; color: #333;">Receipt Summary</h3>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Order ID:</strong> <span style="font-family: monospace; color: #333;"><?= htmlspecialchars($order['order_uid']) ?></span></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Date:</strong> <?= date('F j, Y, g:i a', strtotime($order['updated_at'])) ?></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Amount Paid:</strong> <span style="font-weight: bold; color: #007bff;"><?= htmlspecialchars(format_currency($order['amount'], $order['currency'])) ?></span></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Payment Method:</strong> <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $order['payment_method']))) ?></p>
        <?php if ($order['type'] === 'game_purchase' && !empty($order['game_id'])): ?>
            <p style="margin-bottom: 0.5rem; color: #666;"><strong>Transaction Type:</strong> Game Purchase</p>
        <?php else: ?>
            <p style="margin-bottom: 0.5rem; color: #666;"><strong>Transaction Type:</strong> Top-up</p>
        <?php endif; ?>
        <?php if (!empty($order['game_title'])): ?>
            <p style="margin-bottom: 0;"><strong>Game:</strong> <?= htmlspecialchars($order['game_title']) ?></p>
        <?php endif; ?>
    </div>

    <a href="/history" class="btn" style="display: inline-block; margin-top: 1.5rem; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">View Order History</a>
</div>
