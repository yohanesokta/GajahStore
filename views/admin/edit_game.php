<?php
$game = $data['game'] ?? null;
$isEdit = $game !== null;
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
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="1000" value="<?= htmlspecialchars($game['price'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Game Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if ($isEdit && $game['image_url']): ?>
                <div class="current-image" style="margin-top: 1rem;">
                    <p style="font-size: 0.9rem; color: var(--color-grey);">Current image:</p>
                    <img src="/<?= htmlspecialchars($game['image_url']) ?>" alt="Current Image" style="max-width: 150px; border-radius: 0.5rem; margin-top: 0.5rem;">
                </div>
            <?php endif; ?>
        </div>
        <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn" style="flex-grow: 1;"><?= $isEdit ? 'Update Game' : 'Add Game' ?></button>
            <a href="/admin/games" class="btn btn-secondary" style="flex-grow: 1;">Cancel</a>
        </div>
    </form>
</div>
