<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

include "../../includes/header.php";

// ambil kategori
$kategori = $conn->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);

// ambil data transaksi
$stmt = $conn->prepare("SELECT * FROM transaksi WHERE id_transaksi=?");
$stmt->execute([$_GET['id']]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Edit Transaksi</h3>

    <form action="../../process/transaksi_proses.php" method="POST">

        <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="<?= $data['tanggal'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>"
                        <?= $data['id_kategori']==$k['id_kategori']?'selected':'' ?>>
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control"
                   value="<?= $data['nominal'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= $data['keterangan'] ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "../../includes/footer.php"; ?>