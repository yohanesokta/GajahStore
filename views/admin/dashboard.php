<h1>Admin Dashboard</h1>
<p style="color: var(--color-grey); margin-top: -0.5rem; margin-bottom: 2rem;">Overview of the rental store's performance.</p>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3>Total Users</h3>
        <p><?= $data['stats']['total_users'] ?></p>
    </div>
    <div class="stat-card">
        <h3>Total Games</h3>
        <p><?= $data['stats']['total_games'] ?></p>
    </div>
    <div class="stat-card">
        <h3>Total Rentals</h3>
        <p><?= $data['stats']['total_rentals'] ?></p>
    </div>
    <div class="stat-card">
        <h3>Active Rentals</h3>
        <p><?= $data['stats']['active_rentals'] ?></p>
    </div>
</div>

<div class="dashboard-lists">
    <div class="list-container">
        <h2>Most Rented Games</h2>
        <ol class="styled-list">
            <?php foreach($data['stats']['popular_games'] as $game): ?>
                <li>
                    <span><?= htmlspecialchars($game['Judul']) ?></span>
                    <span><?= $game['rental_count'] ?> rentals</span>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
    <div class="list-container">
        <h2>Highest Rated Games</h2>
        <ol class="styled-list">
             <?php foreach($data['stats']['highest_rated_games'] as $game): ?>
                <li>
                    <span><?= htmlspecialchars($game['Judul']) ?></span>
                    <span><?= number_format($game['avg_rating'], 1) ?> ★</span>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>

<div class="admin-quick-actions">
    <h2>Quick Management</h2>
    <a href="/admin/games" class="btn">Manage Games</a>
    <a href="/admin/users" class="btn">Manage Users</a>
    <a href="/admin/transaksi" class="btn">View All Rentals</a>
</div>
