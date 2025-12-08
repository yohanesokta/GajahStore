<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="">Welcome to GameStore</h1>
<p style="color: var(--color-grey); max-width: 600px; margin: 0 0 2rem 0;">The best place to rent your favorite games. Fast, secure, and reliable.</p>

<div class="search-bar">
    <form action="/" method="GET">
        <input type="text" name="search" style="padding:0 10px;" placeholder="Search for any game..." value="<?= htmlspecialchars($data['searchTerm'] ?? '') ?>">
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
                <img src="/<?= htmlspecialchars($game['URLGambar'] ?? '') ?>" alt="<?= htmlspecialchars($game['Judul'] ?? '') ?>">
                <div class="game-card-content">
                    <h3><?= htmlspecialchars($game['Judul'] ?? '') ?></h3>
                    <p>
                        <span class="genre"><?= htmlspecialchars($game['Genre'] ?? '') ?></span> | 
                        <span class="platform"><?= htmlspecialchars($game['NamaPlatform'] ?? '') ?></span>
                    </p>
                </div>
                <div class="game-card-footer">
                    <a href="/game/<?= $game['IDGame'] ?>" class="btn">Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</body>
</html>