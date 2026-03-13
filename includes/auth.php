<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userID'])) {
    header('Location: /WebProE2300582/login.php');
    exit;
}

function requireRole(...$roles) {
    if (!in_array($_SESSION['role'] ?? '', $roles)) {
        header('Location: /WebProE2300582/index.php');
        exit;
    }
}
?>