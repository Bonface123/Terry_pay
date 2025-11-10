<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from project root if phpdotenv is available
try {
    if (class_exists(Dotenv::class)) {
        $envDir = dirname(__DIR__);
        if (is_dir($envDir) && file_exists($envDir . '/.env')) {
            $dotenv = Dotenv::createImmutable($envDir);
            $dotenv->load();
        }
    }
} catch (Throwable $e) {
    // Silently continue with defaults if .env is missing or Dotenv not installed
}

$host = $_ENV['DB_HOST'] ?? 'localhost';
$db   = $_ENV['DB_NAME'] ?? 'fxdobxel_gm_advocates_db';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASS'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
} catch (PDOException $e) {
    // Graceful fallback: allow pages to render placeholders if DB is unavailable
    $pdo = null;
}