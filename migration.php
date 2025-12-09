<?php
/**
 * Migration Script
 * 
 * This script migrates data from the 'gajah_store.sql' dump file
 * into the new rental application database structure. 
 * 
 * HOW TO RUN:
 * 1. Make sure this file is in the root directory of your project.
 * 2. Make sure 'gajah_store.sql' is in the 'models/' directory.
 * 3. Run from the command line: php migration.php
 * 4. After running, for security, DELETE THIS FILE.
 */

// --- SETUP ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
set_time_limit(300); // 5 minutes execution time

require_once 'config/config.php';

echo "<pre>";
echo "Starting Migration...\n\n";

// --- DATABASE CONNECTION ---
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}
echo "Database connection successful.\n";

// --- HELPER FUNCTION ---

/**
 * Parses an SQL INSERT statement to extract the values.
 * Example: INSERT INTO `table` (`col1`, `col2`) VALUES (1, 'A'),(2, 'B');
 * Returns: [[1, 'A'], [2, 'B']]
 */
function parse_insert_values($sql, $tableName) {
    $matches = [];
    // This regex looks for "INSERT INTO `tableName` ... VALUES " and captures the value sets.
    preg_match_all("/INSERT INTO `" . $tableName . "` .*? VALUES\s*(.*?);/is", $sql, $matches);
    
    if (!isset($matches[1][0])) {
        return [];
    }

    $valuesStr = $matches[1][0];
    $rows = [];
    // This regex splits the VALUES string into individual parenthesized groups like (1, 'A', 'B')
    preg_match_all("/\((.*?)\)/", $valuesStr, $rows);

    if (!isset($rows[1])) {
        return [];
    }

    $data = [];
    foreach ($rows[1] as $row) {
        // This splits the comma-separated values inside the parentheses
        $cols = str_getcsv($row, ',', "'");
        $cols = array_map('trim', $cols);
        $data[] = $cols;
    }
    return $data;
}


// --- MIGRATION LOGIC ---

$sql_content = file_get_contents('models/gajah_store.sql');
if ($sql_content === false) {
    die("Could not read models/gajah_store.sql\n");
}
echo "Read 'gajah_store.sql' file.\n";

// Wrap everything in a transaction
$pdo->beginTransaction();
try {
    // 1. Disable foreign key checks and truncate tables
    echo "Disabling foreign key checks and clearing old data...\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0;");
    $pdo->exec("TRUNCATE TABLE `detailsewa`;");
    $pdo->exec("TRUNCATE TABLE `transaksisewa`;");
    $pdo->exec("TRUNCATE TABLE `rating`;");
    $pdo->exec("TRUNCATE TABLE `kaset`;");
    $pdo->exec("TRUNCATE TABLE `game`;");
    $pdo->exec("TRUNCATE TABLE `platform`;");
    $pdo->exec("TRUNCATE TABLE `pengguna`;");

    // 2. Migrate Platforms
    echo "Migrating platforms...\n";
    $platforms = parse_insert_values($sql_content, 'platforms');
    $stmt = $pdo->prepare("INSERT INTO `platform` (`IDPlatform`, `NamaPlatform`) VALUES (?, ?)");
    foreach ($platforms as $platform) {
        $stmt->execute($platform);
    }
    echo "  > Migrated " . count($platforms) . " platforms.\n";

    // 3. Migrate Users
    echo "Migrating users...\n";
    $users = parse_insert_values($sql_content, 'users');
    $stmt = $pdo->prepare("INSERT INTO `pengguna` (`IDPengguna`, `Nama`, `Email`, `Password`, `Role`) VALUES (?, ?, ?, ?, ?)");
    foreach ($users as $user) {
        $stmt->execute($user);
    }
    echo "  > Migrated " . count($users) . " users.\n";
    
    // 4. Migrate Games
    echo "Migrating games...\n";
    $games = parse_insert_values($sql_content, 'games');
    $stmt = $pdo->prepare("INSERT INTO `game` (`IDGame`, `Judul`, `Genre`, `IDPlatform`, `URLGambar`) VALUES (?, ?, ?, ?, ?)");
    $kasetStmt = $pdo->prepare("INSERT INTO `kaset` (`IDGame`) VALUES (?)");
    $gameCount = 0;
    $kasetCount = 0;

    foreach ($games as $game) {
        // Old structure: id, title, genre, platform_id, price, currency, image_url
        // New structure: IDGame, Judul, Genre, IDPlatform, URLGambar
        $newGameData = [
            $game[0], // id
            $game[1], // title
            $game[2], // genre
            $game[3], // platform_id
            $game[6]  // image_url
        ];
        $stmt->execute($newGameData);
        $gameCount++;

        // Add 5 kaset as inventory for each game
        $gameId = $game[0];
        for ($i=0; $i<5; $i++) {
            $kasetStmt->execute([$gameId]);
            $kasetCount++;
        }
    }
    echo "  > Migrated " . $gameCount . " games.\n";
    echo "  > Created " . $kasetCount . " kaset for inventory.\n";

    // Re-enable foreign key checks
    echo "Re-enabling foreign key checks...\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");
    
    // Commit the transaction
    $pdo->commit();
    
    echo "\n--- MIGRATION SUCCESSFUL! ---\n";
    echo "Please DELETE this script ('migration.php') immediately.\n";

} catch (Exception $e) {
    // An error occurred; rollback the transaction
    $pdo->rollBack();
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");
    die("\n--- MIGRATION FAILED! ---\nAn error occurred: " . $e->getMessage() . "\nAll changes have been rolled back.\n");
}

echo "</pre>";

?>
