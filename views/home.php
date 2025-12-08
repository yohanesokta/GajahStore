<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to GameStore</h1>
<p style="text-align: center; color: var(--color-grey); max-width: 600px; margin: 0 auto 2rem auto;">The best place to top up your favorite games. Fast, secure, and reliable.</p>

<div class="search-bar">
    <form action="/" method="GET">
        <input type="text" name="search" placeholder="Search for any game..." value="<?= htmlspecialchars($data['searchTerm'] ?? '') ?>">
        <button type="submit" class="btn">Search</button>
    </form>
</div>

<h2>Featured Games</h2>

<?php if (empty($data['games'])): ?>
    <div class="alert alert-danger" style="text-align: center;">No games found matching your search criteria.</div>
<?php else: ?>
    <div class="game-grid">
        <?php foreach ($data['games'] as $game): ?>
            <div class="game-card">
                <img src="/<?= htmlspecialchars($game['image_url']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
                <div class="game-card-content">
                    <h3><?= htmlspecialchars($game['title']) ?></h3>
                    <p>
                        <span class="genre"><?= htmlspecialchars($game['genre']) ?></span> | 
                        <span class="platform"><?= htmlspecialchars($game['platform_name']) ?></span>
                    </p>
                </div>
                <div class="game-card-footer">
                    <span class="price">Rp. <?= number_format($game['price']) ?></span>
                    <a href="/game/<?= $game['id'] ?>" class="btn">Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</body>
</html>