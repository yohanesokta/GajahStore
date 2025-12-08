<?php
// views/admin/report_top_selling.php
$topGames = $data['topGames'];
?>
<div class="admin-container" style="max-width: 800px; margin: 2rem auto; padding: 2rem; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
    <h2 style="margin-bottom: 1.5rem; color: #333;">Top 5 Selling Games</h2>

    <?php if (empty($topGames)): ?>
        <p style="text-align: center; color: #555;">No sales data available yet. Please ensure there are paid game purchase orders.</p>
    <?php else: ?>
        <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 1.5rem;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd;">Rank</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd;">Game</th>
                    <th style="padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd;">Total Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topGames as $index => $game): ?>
                    <tr style="<?= $index % 2 == 0 ? 'background-color: #fcfcfc;' : '' ?>">
                        <td style="padding: 10px 15px; border-bottom: 1px solid #eee;"><strong>#<?= $index + 1 ?></strong></td>
                        <td style="padding: 10px 15px; border-bottom: 1px solid #eee;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <img src="/<?= htmlspecialchars($game['image_url']) ?>" alt="<?= htmlspecialchars($game['title']) ?>" style="width: 80px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                <span style="font-weight: 500; color: #333;"><?= htmlspecialchars($game['title']) ?></span>
                            </div>
                        </td>
                        <td style="padding: 10px 15px; border-bottom: 1px solid #eee; color: #555;"><?= htmlspecialchars($game['total_sales']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <div style="margin-top: 2rem; text-align: center;">
        <a href="/admin" class="btn btn-secondary" style="display: inline-block; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px;">Back to Dashboard</a>
    </div>
</div>
