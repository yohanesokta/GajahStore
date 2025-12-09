<?php
ob_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once 'config/config.php';
require_once 'controllers/base.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


$request_uri = $_SERVER['REQUEST_URI'];
$request_path = parse_url($request_uri, PHP_URL_PATH);
$path_parts = explode('/', trim($request_path, '/'));

$controllerName = $path_parts[0] ?: 'home'; 
$methodName = $path_parts[1] ?? 'index';
$param1 = $path_parts[2] ?? null;
$param2 = $path_parts[3] ?? null;


function loadController($name, $db) {
    $controllerFile = "controllers/{$name}.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $className = ucfirst($name) . 'Controller';
        if (class_exists($className)) {
            return new $className($db);
        }
    }
    return null;
}


if ($controllerName === 'home' || $controllerName === '' || $controllerName === 'index.php') {
    $userController = loadController('user', $pdo);
    if ($userController) $userController->index(); else notFound();


} elseif ($controllerName === 'login') {
    $authController = loadController('auth', $pdo);
    if ($authController) $authController->login(); else notFound();

} elseif ($controllerName === 'register') {
    $authController = loadController('auth', $pdo);
    if ($authController) $authController->register(); else notFound();

} elseif ($controllerName === 'logout') {
    $authController = loadController('auth', $pdo);
    if ($authController) $authController->logout(); else notFound();


} elseif ($controllerName === 'history') {
    $userController = loadController('user', $pdo);
    if ($userController) $userController->history(); else notFound();


} elseif ($controllerName === 'game' && $methodName) {
    $userController = loadController('user', $pdo);
    if ($userController) $userController->show($methodName); else notFound();


} elseif ($controllerName === 'rent' && $methodName) {
    $userController = loadController('user', $pdo);
    if ($userController) $userController->rent($methodName); else notFound();


} elseif ($controllerName === 'payment' && $methodName) {
    $paymentController = loadController('payment', $pdo);
    if (!$paymentController) { notFound(); }

    
    
    
    if (in_array($methodName, ['simulate', 'confirm', 'success']) && $param1) {
        $paymentController->$methodName($param1);
    } else {
        notFound();
    }


} elseif ($controllerName === 'rate' && $methodName) {
    $userController = loadController('user', $pdo);
    if ($userController) $userController->rate($methodName); else notFound();


} elseif ($controllerName === 'admin') {
    $adminController = loadController('admin', $pdo);
    if (!$adminController) { notFound(); }
    
    
    
    
    
    if ($methodName === 'index' && !$param1) {
        $adminController->index();
    } elseif ($methodName === 'games') {
        if ($param1 === 'edit' && $param2) $adminController->editGame($param2);
        elseif ($param1 === 'new') $adminController->editGame();
        elseif ($param1 === 'delete' && $param2) $adminController->deleteGame($param2);
        else $adminController->games();
    } elseif ($methodName === 'users') {
        if ($param1 === 'edit' && $param2) $adminController->editUser($param2);
        elseif ($param1 === 'new') $adminController->editUser();
        elseif ($param1 === 'delete' && $param2) $adminController->deleteUser($param2);
        else $adminController->users();
    } elseif ($methodName === 'transaksi') { 
        $adminController->transaksi();
    } elseif ($methodName === 'addstock' && $param1 && $_SERVER['REQUEST_METHOD'] === 'POST') { 
        $adminController->addStock($param1);
    } elseif ($methodName === 'deletekaset' && $param1 && $param2) { 
        $adminController->deleteKaset($param1, $param2);
    } else {
        
        if(method_exists($adminController, $methodName)) {
            $adminController->$methodName();
        } else {
            $adminController->index();
        }
    }

} else {
    notFound();
}


function notFound() {
    http_response_code(404);
    include 'views/partials/header.php';
    echo "<h1>404 Not Found</h1><p>The page you requested could not be found.</p>";
    include 'views/partials/footer.php';
    exit();
}
