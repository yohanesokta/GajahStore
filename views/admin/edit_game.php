<?php
// views/admin/edit_game.php
$game = $data['game'] ?? null;
$kasets = $data['kasets'] ?? [];
$isEdit = $game !== null;
?>
<div class="form-container" style="max-width: 700px; margin: auto;">
    <h2><?= $isEdit ? 'Edit Game' : 'Add New Game' ?></h2>

    <form action="<?= $isEdit ? '/admin/games/edit/' . $game['IDGame'] : '/admin/games/new' ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($game['Judul'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($game['Genre'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="platform_id">Platform</label>
            <select id="platform_id" name="platform_id" required>
                <option value="" disabled <?= !$isEdit ? 'selected' : '' ?>>-- Select a Platform --</option>
                <?php foreach ($data['platforms'] as $platform): ?>
                    <option value="<?= $platform['IDPlatform'] ?>" <?= ($game['IDPlatform'] ?? '') == $platform['IDPlatform'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($platform['NamaPlatform']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="image">Game Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if ($isEdit && $game['URLGambar']): ?>
                <div class="current-image" style="margin-top: 1rem;">
                    <p>Current image:</p>
                    <img src="/<?= htmlspecialchars($game['URLGambar']) ?>" alt="Current Image" style="max-width: 150px; border-radius: 0.5rem; margin-top: 0.5rem;">
                </div>
            <?php endif; ?>
        </div>
        <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn"><?= $isEdit ? 'Update Game' : 'Add Game' ?></button>
            <a href="/admin/games" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php if ($isEdit): ?>
<div class="inventory-container" style="max-width: 700px; margin: 2rem auto; padding: 2rem; border-top: 1px solid #ddd;">
    <h3>Inventory Management / Stok Kaset</h3>
    
    <div class="add-stock-form" style="margin-bottom: 2rem;">
        <h4>Add New Stock</h4>
        <form action="/admin/addstock/<?= $game['IDGame'] ?>" method="POST" style="display: flex; gap: 1rem; align-items: flex-end;">
            <div class="form-group" style="flex-grow: 1; margin: 0;">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required>
            </div>
            <button type="submit" class="btn">Add Stock</button>
        </form>
    </div>

    <h4>Current Stock</h4>
    <?php if (empty($kasets)): ?>
        <p>No kaset found for this game yet. Add some stock!</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Kaset ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kasets as $kaset): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($kaset['IDKaset']) ?></td>
                        <td>
                            <span class="status status-<?= strtolower(htmlspecialchars($kaset['Status'])) ?>">
                                <?= htmlspecialchars($kaset['Status']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($kaset['Status'] === 'Tersedia'): ?>
                                <a href="/admin/deletekaset/<?= $game['IDGame'] ?>/<?= $kaset['IDKaset'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this kaset?');">Delete</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Cannot Delete</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<style>
.status-tersedia { background-color: var(--color-success); color: white; }
.status-disewa { background-color: var(--color-warning); color: #333; }
</style>
<?php endif; ?>