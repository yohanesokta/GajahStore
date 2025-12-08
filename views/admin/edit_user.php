<?php
$user = $data['user'] ?? null;
$isEdit = $user !== null;
?>
<div class="form-container">
    <h2><?= $isEdit ? 'Edit User' : 'Add New User' ?></h2>

    <form action="<?= $isEdit ? '/admin/users/edit/' . $user['id'] : '/admin/users/new' ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user" <?= ($user['role'] ?? 'user') == 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= ($user['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <?php if (!$isEdit): ?>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Create a password for the new user">
        </div>
        <?php endif; ?>
        <div class="form-actions" style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn" style="flex-grow: 1;"><?= $isEdit ? 'Update User' : 'Add User' ?></button>
            <a href="/admin/users" class="btn btn-secondary" style="flex-grow: 1;">Cancel</a>
        </div>
    </form>
</div>
