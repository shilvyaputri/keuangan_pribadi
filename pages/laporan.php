<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

include "../includes/header.php";

// Ambil transaksi user
$stmt = $conn->prepare("
    SELECT t.*, k.nama_kategori, jt.nama_jenis
    FROM transaksi t
    JOIN kategori k ON t.id_kategori = k.id_kategori
    JOIN jenis_transaksi jt ON k.id_jt = jt.id_jt
    WHERE t.id_user = ?
    ORDER BY t.tanggal DESC
");

$stmt->execute([$_SESSION['user']['id']]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hitung total
$total_pemasukan = 0;
$total_pengeluaran = 0;

foreach ($data as $d) {

    if (strtolower($d['nama_jenis']) == 'pemasukan') {

        $total_pemasukan += $d['nominal'];

    } else {

        $total_pengeluaran += $d['nominal'];

    }
}

$saldo = $total_pemasukan - $total_pengeluaran;
?>

<div class="container">
    <h3 class="mb-4">Laporan Keuangan</h3>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Pemasukan</h6>
                    <h4>Rp <?= number_format($total_pemasukan,0,',','.') ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6>Total Pengeluaran</h6>
                    <h4>Rp <?= number_format($total_pengeluaran,0,',','.') ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Saldo</h6>
                    <h4>Rp <?= number_format($saldo,0,',','.') ?></h4>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            Detail Transaksi
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $no = 1; ?>

                    <?php foreach($data as $d): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= $d['tanggal'] ?></td>

                        <td><?= $d['nama_kategori'] ?></td>

                        <td>
                            <?php if(strtolower($d['nama_jenis']) == 'pemasukan'): ?>
                                <span class="badge bg-success">
                                    Pemasukan
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger">
                                    Pengeluaran
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if(strtolower($d['nama_jenis']) == 'pemasukan'): ?>
                                <span class="text-success fw-bold">
                                    + Rp <?= number_format($d['nominal'],0,',','.') ?>
                                </span>
                            <?php else: ?>
                                <span class="text-danger fw-bold">
                                    - Rp <?= number_format($d['nominal'],0,',','.') ?>
                                </span>
                            <?php endif; ?>
                        </td>

                        <td><?= $d['keterangan'] ?></td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>

<?php include "../includes/footer.php"; ?>