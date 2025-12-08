<?php
// views/payment/qris_simulate.php
// Memastikan helper di-load untuk format_currency
require_once 'lib/helper.php'; 
$order = $data['order'];
?>
<div class="payment-container" style="text-align: center; max-width: 450px; margin: 2rem auto; padding: 2rem; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
    <h2 style="color: #333; margin-bottom: 1.5rem;">Complete Your Payment</h2>
    <p style="color: #555; margin-bottom: 1.5rem;">Please scan the QR code below to complete your payment.</p>
    
    <div class="order-details" style="margin: 1.5rem 0; padding: 1rem; border-radius: 4px; border: 1px dashed #eee; background-color: #fcfcfc; text-align: left;">
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Order ID:</strong> <span style="font-family: monospace; color: #333;"><?= htmlspecialchars($order['order_uid']) ?></span></p>
        <p style="margin-bottom: 0.5rem; color: #666;"><strong>Total Amount:</strong> <span style="font-weight: bold; color: #007bff; font-size: 1.1rem;"><?= htmlspecialchars(format_currency($order['amount'], $order['currency'])) ?></span></p>
        <?php if ($order['type'] === 'game_purchase' && !empty($order['game_id'])): ?>
            <p style="margin-bottom: 0;"><strong>Product:</strong> Game Purchase</p>
        <?php else: ?>
            <p style="margin-bottom: 0;"><strong>Product:</strong> Top-up</p>
        <?php endif; ?>
    </div>

    <div class="qr-code" style="margin: 2rem 0;">
        <img src="<?= htmlspecialchars($data['qr_code_url']) ?>" alt="QR Code for Payment" style="max-width: 100%; height: auto; border: 1px solid #eee; padding: 5px; border-radius: 5px;">
    </div>

    <p style="margin-top: 1.5rem; color: #555;">After making the payment using your QRIS-supported app, click the button below to simulate payment success.</p>

    <form action="/payment/confirm/<?= htmlspecialchars($order['order_uid']) ?>" method="POST" style="margin-top: 1.5rem;">
        <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem; background-color: #28a745; border-color: #28a745; color: #fff; border-radius: 5px; cursor: pointer;">Simulate Payment Success</button>
    </form>
    
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red; margin-top: 1rem;">Payment failed. Please try again.</p>
    <?php endif; ?>
</div>
