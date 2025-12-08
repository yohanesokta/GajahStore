<?php
class DatabaseConnection{ 
    private static $instance = null;
    public static function getConnection() {
        $HOST = $_ENV['MYSQL_HOST'] ?? "";
        $USERNAME = $_ENV["MYSQL_DB_USER"] ?? "";
        $PASSWORD = $_ENV["MYSQL_ROOT_PASSWORD"] ?? "";
        $DATABASE = $_ENV["MYSQL_DATABASE"] ?? "";
        try {
            self::$instance = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DATABASE);
        } catch (Exception $e) { 
            die("Koneksi gagal: " . $e->getMessage());
        }
        return self::$instance;
    }
}