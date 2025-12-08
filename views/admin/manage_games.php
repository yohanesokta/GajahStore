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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['games'])): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No games found.</td>
                </tr>
            <?php else: ?>
                <?php $no=0; foreach ($data['games'] as $game): $no++;?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?= htmlspecialchars($game['IDGame'] ?? '') ?></td>
                        <td><img src="/<?= htmlspecialchars($game['URLGambar'] ?? '') ?>" alt="<?= htmlspecialchars($game['Judul'] ?? '') ?>" style="width: 50px; border-radius: 4px;"></td>
                        <td><?= htmlspecialchars($game['Judul'] ?? '') ?></td>
                        <td><?= htmlspecialchars($game['Genre'] ?? '') ?></td>
                        <td><?= htmlspecialchars($game['NamaPlatform'] ?? '') ?></td>
                        <td class="action-links">
                            <a href="/admin/games/edit/<?= htmlspecialchars($game['IDGame'] ?? '') ?>">Edit</a>
                            <a href="/admin/games/delete/<?= htmlspecialchars($game['IDGame'] ?? '') ?>" onclick="return confirm('Are you sure you want to delete this game?')" class="delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
