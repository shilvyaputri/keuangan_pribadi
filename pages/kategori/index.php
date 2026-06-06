<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

include "../../includes/header.php";

// join ke jenis_transaksi
$stmt = $conn->query("
    SELECT kategori.*, jenis_transaksi.nama_jenis 
    FROM kategori
    JOIN jenis_transaksi ON kategori.id_jt = jenis_transaksi.id_jt
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Kategori</h3>

    <a href="form.php" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; foreach($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama_kategori'] ?></td>
                <td><?= $d['nama_jenis'] ?></td>
                <td>
                    <a href="form.php?id=<?= $d['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="../../process/kategori_proses.php?hapus=<?= $d['id_kategori'] ?>"
                       onclick="return confirm('Hapus data?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../../includes/footer.php"; ?>