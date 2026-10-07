<?php
/**
 * Database connection.
 *
 * Local development defaults:
 *   host=localhost, database=social_media_db, user=root, password=""
 *
 * Production/Render:
 * Set MYSQL_HOST, MYSQL_PORT, MYSQL_DATABASE, MYSQL_USER and MYSQL_PASSWORD
 * as environment variables in the Render dashboard.
 */
$host = getenv('MYSQL_HOST') ?: 'localhost';
$port = getenv('MYSQL_PORT') ?: '3306';
$dbname = getenv('MYSQL_DATABASE') ?: 'social_media_db';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';

try {
    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    http_response_code(500);
    exit("Database connection failed. Please check the server configuration.");
}
?>
