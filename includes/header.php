<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// URL untuk menu
$current = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keuangan Pribadi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #343a40;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .active-menu {
            background: #495057;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

    <h4 class="text-center py-3">💰 Keuangan</h4>

    <!-- Dashboard -->
    <?php if ($_SESSION['user']['role'] == 1): ?>
        <a href="/keuangan_pribadi/pages/admin/dashboard.php"
           class="<?= strpos($current, 'admin/dashboard.php') !== false ? 'active-menu' : '' ?>">
            Dashboard
        </a>
    <?php else: ?>
        <a href="/keuangan_pribadi/pages/user/dashboard.php"
           class="<?= strpos($current, 'user/dashboard.php') !== false ? 'active-menu' : '' ?>">
            Dashboard
        </a>
    <?php endif; ?>

    <!-- Menu Admin -->
    <?php if ($_SESSION['user']['role'] == 1): ?>
        <a href="/keuangan_pribadi/pages/admin/user/index.php"
           class="<?= strpos($current, '/admin/user/') !== false ? 'active-menu' : '' ?>">
            Manajemen User
        </a>
    <?php endif; ?>

    <!-- Transaksi -->
    <a href="/keuangan_pribadi/pages/transaksi/index.php"
       class="<?= strpos($current, 'transaksi') !== false ? 'active-menu' : '' ?>">
        Transaksi
    </a>

    <!-- Kategori -->
    <a href="/keuangan_pribadi/pages/kategori/index.php"
       class="<?= strpos($current, 'kategori') !== false ? 'active-menu' : '' ?>">
        Kategori
    </a>

    <!-- Laporan -->
    <a href="/keuangan_pribadi/pages/laporan.php"
       class="<?= strpos($current, 'laporan') !== false ? 'active-menu' : '' ?>">
        Laporan
    </a>

    <!-- Profil Saya (User Only) -->
    <?php if ($_SESSION['user']['role'] == 2): ?>
        <a href="/keuangan_pribadi/pages/user/profil.php"
            class="<?= strpos($current, 'profil') !== false ? 'active-menu' : '' ?>">
            Profil Saya
        </a>
    <?php endif; ?>

    <hr>

    <!-- Logout -->
    <a href="/keuangan_pribadi/auth/logout.php">
        Logout
    </a>

</div>

<!-- Content -->
<div class="content">

<!-- Navbar -->
<nav class="navbar navbar-light bg-light mb-4">
    <div class="container-fluid">

        <span class="navbar-brand">
            Keuangan Pribadi
        </span>

        <span>
            Halo, <?= $_SESSION['user']['nama'] ?? 'User'; ?>
        </span>

    </div>
</nav>