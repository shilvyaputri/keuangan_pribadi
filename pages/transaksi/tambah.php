<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

include "../../includes/header.php";

// ambil kategori
$kategori = $conn->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Tambah Transaksi</h3>

    <form action="../../process/transaksi_proses.php" method="POST">

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- pilih --</option>
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>">
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "../../includes/footer.php"; ?>