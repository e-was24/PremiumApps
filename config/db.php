<?php
require __DIR__ . "/envLoader.php";
loadEnv(__DIR__ . "/.env");

$isLocal = in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']);

$host   = $isLocal ? $_ENV['DB_HOST']      : $_ENV['PROD_DB_HOST'];
$user   = $isLocal ? $_ENV['DB_USER']      : $_ENV['PROD_DB_USER'];
$pass   = $isLocal ? $_ENV['DB_PASS']      : $_ENV['PROD_DB_PASS'];
$dbname = $isLocal ? $_ENV['DB_NAME']      : $_ENV['PROD_DB_NAME'];

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "msg" => "Database connection failed"
    ]);
    exit;
}
