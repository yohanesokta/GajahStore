<h1>Manage Users</h1>
<a href="/admin/users/new" class="btn btn-success" style="margin-bottom: 1.5rem;">Add New User</a>

<?php if(isset($_GET['error']) && $_GET['error'] === 'self_delete'): ?>
<div class="alert alert-danger">You cannot delete your own admin account.</div>
<?php endif; ?>

<div class="table-responsive">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['users'])): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No users found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td class="action-links">
                            <a href="/admin/users/edit/<?= $user['id'] ?>">Edit</a>
                            <?php if ($_SESSION['user_id'] != $user['id']): // Prevent self-delete button from showing ?>
                            <a href="/admin/users/delete/<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')" class="delete">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
