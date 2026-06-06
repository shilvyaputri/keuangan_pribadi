<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

include "../../includes/header.php";

$stmt = $conn->prepare("
SELECT
    SUM(CASE WHEN jt.nama_jenis='Pemasukan' THEN t.nominal ELSE 0 END) pemasukan,
    SUM(CASE WHEN jt.nama_jenis='Pengeluaran' THEN t.nominal ELSE 0 END) pengeluaran
FROM transaksi t
JOIN kategori k ON t.id_kategori = k.id_kategori
JOIN jenis_transaksi jt ON k.id_jt = jt.id_jt
WHERE t.id_user = ?
");

$stmt->execute([$_SESSION['user']['id']]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

$pemasukan = $data['pemasukan'] ?? 0;
$pengeluaran = $data['pengeluaran'] ?? 0;
$saldo = $pemasukan - $pengeluaran;
?>

<div class="container">

    <h3 class="mb-4">
        Selamat Datang,
        <?= $_SESSION['user']['nama']; ?>
    </h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Pemasukan</h5>
                    <h3>Rp <?= number_format($pemasukan,0,',','.') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Pengeluaran</h5>
                    <h3>Rp <?= number_format($pengeluaran,0,',','.') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Saldo</h5>
                    <h3>Rp <?= number_format($saldo,0,',','.') ?></h3>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include "../../includes/footer.php"; ?>