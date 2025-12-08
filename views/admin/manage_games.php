<h1>Manage Games</h1>
<a href="/admin/games/new" class="btn btn-success" style="margin-bottom: 1.5rem;">Add New Game</a>

<div class="table-responsive">
    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Platform</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['games'])): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No games found.</td>
                </tr>
            <?php else: ?>
                <?php $no=0; foreach ($data['games'] as $game): $no++;?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?= $game['id'] ?></td>
                        <td><img src="/<?= htmlspecialchars($game['image_url']) ?>" alt="" style="width: 50px; border-radius: 4px;"></td>
                        <td><?= htmlspecialchars($game['title']) ?></td>
                        <td><?= htmlspecialchars($game['genre']) ?></td>
                        <td><?= htmlspecialchars($game['platform_name']) ?></td>
                        <td>Rp. <?= number_format($game['price']) ?></td>
                        <td class="action-links">
                            <a href="/admin/games/edit/<?= $game['id'] ?>">Edit</a>
                            <a href="/admin/games/delete/<?= $game['id'] ?>" onclick="return confirm('Are you sure you want to delete this game?')" class="delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
