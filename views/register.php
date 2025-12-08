<div class="form-container">
    <h2>Create an Account</h2>

    <?php if (!empty($data['errors'])): ?>
        <div class="alert alert-danger">
            <strong>Oops!</strong> Please correct the following errors:
            <ul>
                <?php foreach ($data['errors'] as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/register" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn" style="width: 100%;">Register</button>
    </form>
    <div class="form-footer">
        <p>Already have an account? <a href="/login">Log in</a></p>
    </div>
</div>
