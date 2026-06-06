<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

cekRole(1);

include "../../includes/header.php";

// Total User
$stmtUser = $conn->query("SELECT COUNT(*) as total_user FROM users");
$totalUser = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Total Transaksi
$stmtTransaksi = $conn->query("SELECT COUNT(*) as total_transaksi FROM transaksi");
$totalTransaksi = $stmtTransaksi->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Dashboard Admin</h3>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5>Total User</h5>
                    <h3><?= $totalUser['total_user']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h3><?= $totalTransaksi['total_transaksi']; ?></h3>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include "../../includes/footer.php"; ?>