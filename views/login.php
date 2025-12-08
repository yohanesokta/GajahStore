<div class="form-container">
    <h2>Login</h2>
    
    <?php if (isset($_GET['registered'])): ?>
        <div class="alert alert-success">Registration successful! You can now log in.</div>
    <?php endif; ?>
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($data['error']) ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn" style="width: 100%;">Login</button>
    </form>
    <div class="form-footer">
        <p>Don't have an account? <a href="/register">Sign up</a></p>
    </div>
</div>
