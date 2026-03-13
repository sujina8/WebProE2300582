<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$role = $_SESSION['role'] ?? '';
$name = $_SESSION['name'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $pageTitle ?? 'EduSkill Marketplace' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/WebProE2300582/css/main.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ems-navbar sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/WebProE2300582/index.php">
      <i class="bi bi-mortarboard-fill me-2"></i>EduSkill
    </a>
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="/WebProE2300582/courses.php">
            <i class="bi bi-grid me-1"></i>Browse Courses
          </a>
        </li>

        <?php if ($role === 'provider'): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-building me-1"></i>Provider
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item"
                 href="/WebProE2300582/provider/courses.php">
                <i class="bi bi-journal-text me-2"></i>My Courses
              </a>
            </li>
            <li>
              <a class="dropdown-item"
                 href="/WebProE2300582/provider/reports.php">
                <i class="bi bi-bar-chart me-2"></i>Reports
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>

        <?php if ($role === 'officer'): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-shield-check me-1