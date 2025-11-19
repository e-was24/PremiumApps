<?php
header("Content-Type: application/json");
// proses JSON POST
echo json_encode(["status"=>"success"]);

// =====================
//  READ RAW JSON INPUT
// =====================
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

$username = trim($data["username"] ?? "");
$email    = trim($data["email"] ?? "");
$password = $data["password"] ?? "";

// =====================
//  LOAD DATABASE FILE
// =====================
$data_file = __DIR__ . "/../storage/db/userAccount.json";

if (!file_exists($data_file)) {
    file_put_contents($data_file, "[]");
}

$users = json_decode(file_get_contents($data_file), true);

// =====================
//  BASIC VALIDATION
// =====================
if ($username === "" || $email === "" || $password === "") {
    echo json_encode(["status" => "error", "msg" => "All fields are required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "msg" => "Invalid email format"]);
    exit;
}

if (strlen($username) < 3) {
    echo json_encode(["status" => "error", "msg" => "Username too short"]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(["status" => "error", "msg" => "Password too short"]);
    exit;
}

// =====================
//  CHECK DUPLICATE
// =====================
foreach ($users as $u) {
    if (strtolower($u["email"]) === strtolower($email)) {
        echo json_encode(["status" => "error", "msg" => "Email already registered"]);
        exit;
    }
    if (strtolower($u["username"]) === strtolower($username)) {
        echo json_encode(["status" => "error", "msg" => "Username already taken"]);
        exit;
    }
}

// =====================
//     SECURITY LAYER
// =====================

// Hash password (bcrypt)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Two Security Vectors
$vector1 = bin2hex(random_bytes(16)); 
$vector2 = base64_encode(random_bytes(24)); 

// =====================
//     SAVE NEW USER
// =====================
$users[] = [
    "username"      => $username,
    "email"         => $email,
    "password_hash" => $hashed_password,
    "vector1"       => $vector1,
    "vector2"       => $vector2,
    "role"          => "member",
    "created_at"    => date("Y-m-d H:i:s")
];

// Save JSON
file_put_contents($data_file, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(["status" => "success", "msg" => "Account created successfully"]);
