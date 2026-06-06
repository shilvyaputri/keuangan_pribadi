<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

include "../../includes/header.php";

// ambil data transaksi + kategori + jenis
$stmt = $conn->query("
    SELECT t.*, k.nama_kategori, jt.nama_jenis
    FROM transaksi t
    JOIN kategori k ON t.id_kategori = k.id_kategori
    JOIN jenis_transaksi jt ON k.id_jt = jt.id_jt
    WHERE t.id_user = ".$_SESSION['user']['id']."
    ORDER BY t.tanggal DESC
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Transaksi</h3>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; foreach($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['tanggal'] ?></td>
                <td><?= $d['nama_kategori'] ?></td>
                <td><?= $d['nama_jenis'] ?></td>
                <td>Rp <?= number_format($d['nominal'],0,',','.') ?></td>
                <td><?= $d['keterangan'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $d['id_transaksi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="../../process/transaksi_proses.php?hapus=<?= $d['id_transaksi'] ?>"
                       onclick="return confirm('Hapus?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../../includes/footer.php"; ?>