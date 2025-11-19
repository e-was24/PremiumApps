<?php
header("Content-Type: application/json");

// Path database JSON
$data_file = __DIR__ . "/../storage/db/userAccount.json";

// Load file
if (!file_exists($data_file)) {
    file_put_contents($data_file, "[]");
}

$users = json_decode(file_get_contents($data_file), true);

// POST Data
$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// Basic validation
if ($username === "" || $email === "" || $password === "") {
    echo json_encode(["status" => "error", "msg" => "All fields are required"]);
    exit;
}

// Check duplicate username/email
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

// ========= SECURITY ==========

// password hashing (bcrypt)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// create 2 security vectors
$vector1 = bin2hex(random_bytes(16)); // 32 char
$vector2 = base64_encode(random_bytes(24)); // 32 char

// Save new user
$users[] = [
    "username"      => $username,
    "email"         => $email,
    "password_hash" => $hashed_password,
    "vector1"       => $vector1,
    "vector2"       => $vector2,
    "role"          => "member",
    "created_at"    => date("Y-m-d H:i:s")
];

// Save to file
file_put_contents($data_file, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(["status" => "success", "msg" => "Account created"]);
