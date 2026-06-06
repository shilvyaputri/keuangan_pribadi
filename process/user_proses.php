<!-- Dashboard -->
<a href="/keuangan_pribadi/index.php">
    Dashboard
</a>

<?php if ($_SESSION['user']['role'] == 1): ?>

    <!-- MENU ADMIN -->

    <a href="/keuangan_pribadi/pages/admin/user/index.php">
        Manajemen User
    </a>

    <a href="/keuangan_pribadi/pages/kategori/index.php">
        Kategori
    </a>

    <a href="/keuangan_pribadi/pages/transaksi/index.php">
        Transaksi
    </a>

    <a href="/keuangan_pribadi/pages/laporan.php">
        Laporan
    </a>

<?php else: ?>

    <!-- MENU USER -->

    <a href="/keuangan_pribadi/pages/user/dashboard.php">
        Dashboard Saya
    </a>

    <a href="/keuangan_pribadi/pages/transaksi/index.php">
        Transaksi Saya
    </a>

    <a href="/keuangan_pribadi/pages/laporan.php">
        Laporan Saya
    </a>

    <a href="/keuangan_pribadi/pages/user/profil.php">
        Profil Saya
    </a>

<?php endif; ?>

<hr>

<a href="/keuangan_pribadi/auth/logout.php">
    Logout
</a>