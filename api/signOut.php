<?php
session_start();
ob_start();

// Hapus semua session
$_SESSION = [];
session_destroy();

// Response JSON (opsional, bisa juga langsung redirect)
echo json_encode([
    "status" => "success",
    "msg" => "Logged out successfully"
]);
exit;
