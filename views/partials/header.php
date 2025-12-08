<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($current_page == 'basdat' || $current_page == '') {
    $current_page = 'index.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title'] ?? 'GameStore') ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="/public/css/style.css">
    
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>

<header>
    <div class="container">
        <div class="logo">
            <a href="/">GameStore</a>
        </div>
        <nav>
            <a href="/" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
            <?php if ($isLoggedIn): ?>
                <a href="/history" class="<?= ($current_page == 'history') ? 'active' : '' ?>">My History</a>
                <?php if ($isAdmin): ?>
                    <a href="/admin" class="<?= ($current_page == 'admin') ? 'active' : '' ?>">Admin</a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
        <div class="user-actions">
            <?php if ($isLoggedIn): ?>
                <span class="welcome-msg">Hi, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="/logout">Logout</a>
            <?php else: ?>
                <a href="/register" class="btn btn-secondary">Register</a>
                <a href="/login" class="btn">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main>
    <div class="container">