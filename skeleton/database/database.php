<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$db   = $_ENV['DB_NAME'] ?? '';
$user = $_ENV['DB_USERNAME'] ?? 'root';
$pass = $_ENV['DB_PASSWORD'] ?? '';
$port = $_ENV['DB_PORT'] ?? 3306;

// Better error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli($host, $user, $pass, '', $port);

    // Select DB manually
    if (!$mysqli->select_db($db)) {
        throw new Exception("❌ DB not found: " . $mysqli->error);
    }

    // echo "✅ DB connected aur DB mil gayi!";
    return $mysqli;

} catch (Exception $e) {
    die("❌ DB Connection failed: " . $e->getMessage());
}
