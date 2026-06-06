<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

include "../../includes/header.php";

// ambil jenis transaksi
$jenis = $conn->query("SELECT * FROM jenis_transaksi")->fetchAll(PDO::FETCH_ASSOC);

// cek edit
$data = null;
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM kategori WHERE id_kategori=?");
    $stmt->execute([$_GET['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="container">
    <h3><?= $data ? 'Edit' : 'Tambah' ?> Kategori</h3>

    <form action="../../process/kategori_proses.php" method="POST">
        <input type="hidden" name="id_kategori" value="<?= $data['id_kategori'] ?? '' ?>">

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control"
                   value="<?= $data['nama_kategori'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <select name="id_jt" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php foreach($jenis as $j): ?>
                    <option value="<?= $j['id_jt'] ?>"
                        <?= ($data && $data['id_jt']==$j['id_jt']) ? 'selected' : '' ?>>
                        <?= $j['nama_jenis'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="<?= $data ? 'update' : 'tambah' ?>" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "../../includes/footer.php"; ?>