<?php
session_start();
ob_start();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Ambil JSON raw dari request
$raw = file_get_contents("php://input");
$input = json_decode($raw, true);

// Jika JSON kosong atau rusak
if (!$input) {
    echo json_encode(["status" => "error", "msg" => "Invalid JSON"]);
    exit;
}

$login_id = trim($input["login_id"] ?? "");
$password = $input["password"] ?? "";

// Validasi dasar
if (strlen($login_id) < 3) {
    echo json_encode(["status" => "error", "msg" => "Invalid username/email"]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(["status" => "error", "msg" => "Password too short"]);
    exit;
}

// Path database JSON
$dbFile = __DIR__ . "/../storage/db/userAccount.json";

if (!file_exists($dbFile)) {
    echo json_encode(["status" => "error", "msg" => "Database missing"]);
    exit;
}

// Baca JSON DB
$users = json_decode(file_get_contents($dbFile), true);

if (!is_array($users)) {
    echo json_encode(["status" => "error", "msg" => "Database corrupt"]);
    exit;
}

// Cari user
$found = null;
foreach ($users as $u) {
    if ($u["username"] === $login_id || $u["email"] === $login_id) {
        $found = $u;
        break;
    }
}

if (!$found) {
    echo json_encode(["status" => "error", "msg" => "Account not found"]);
    exit;
}

// Verifikasi password
if (!password_verify($password, $found["password_hash"])) {
    echo json_encode(["status" => "error", "msg" => "Wrong password"]);
    exit;
}

// Simpan session
$_SESSION['logged_in'] = true;
$_SESSION['user'] = [
    "username" => $found["username"],
    "email"    => $found["email"],
    "role"     => $found["role"]
];

// Response sukses
echo json_encode([
    "status" => "success",
    "msg" => "Login success",
    "user" => $_SESSION['user']
]);
exit;
