<?php
// views/admin/edit_game.php
$game = $data['game'] ?? null;
$isEdit = $game !== null;
// Tambahkan daftar mata uang yang didukung
$currencies = ['IDR', 'USD', 'EUR', 'GBP', 'JPY'];
?>
<div class="form-container">
    <h2><?= $isEdit ? 'Edit Game' : 'Add New Game' ?></h2>

    <form action="<?= $isEdit ? '/admin/games/edit/' . $game['id'] : '/admin/games/new' ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($game['title'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($game['genre'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="platform_id">Platform</label>
            <select id="platform_id" name="platform_id" required>
                <option value="" disabled <?= !$isEdit ? 'selected' : '' ?>>-- Select a Platform --</option>
                <?php foreach ($data['platforms'] as $platform): ?>
                    <option value="<?= $platform['id'] ?>" <?= ($game['platform_id'] ?? '') == $platform['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($platform['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group" style="display: flex; gap: 1rem;">
            <div style="flex: 2;">
                <label for="price">Price </label>
                <input type="number" id="price" name="price" step="1" value="<?= htmlspecialchars($game['price'] ?? '') ?>" required>
            </div>
            <div style="flex: 1;">
                <label for="currency">Currency</label>
                <select id="currency" name="currency" required>
                    <?php foreach ($currencies as $currency_code): ?>
                        <option value="<?= $currency_code ?>" <?= ($game['currency'] ?? 'USD') == $currency_code ? 'selected' : '' ?>>
                            <?= htmlspecialchars($currency_code) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Game Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if ($isEdit && $game['image_url']): ?>
                <div class="current-image" style="margin-top: 1rem;">
                    <p>Current image:</p>
                    <img src="/<?= htmlspecialchars($game['image_url']) ?>" alt="Current Image" style="max-width: 150px; border-radius: 0.5rem; margin-top: 0.5rem;">
                </div>
            <?php endif; ?>
        </div>
        <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn"><?= $isEdit ? 'Update Game' : 'Add Game' ?></button>
            <a href="/admin/games" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>