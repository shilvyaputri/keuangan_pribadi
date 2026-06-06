<?php
require_once "../../../includes/auth.php";
require_once "../../../config/database.php";
cekRole(1);

include "../../../includes/header.php";

// ambil role
$roles = $conn->query("SELECT * FROM role")->fetchAll(PDO::FETCH_ASSOC);

// cek edit
$user = null;
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="container">
    <h3><?= $user ? 'Edit' : 'Tambah' ?> User</h3>

    <form action="../../../process/user_proses.php" method="POST">
        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?? '' ?>">

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required
                value="<?= $user['nama'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required
                value="<?= $user['username'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label>Password <?= $user ? '(Kosongkan jika tidak diubah)' : '' ?></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="id_role" class="form-control" required>
                <?php foreach ($roles as $r): ?>
                    <option value="<?= $r['id_role'] ?>"
                        <?= (isset($user) && $user['id_role'] == $r['id_role']) ? 'selected' : '' ?>>
                        <?= $r['nama_role'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="<?= $user ? 'update' : 'tambah' ?>" class="btn btn-success">
            Simpan
        </button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "../../../includes/footer.php"; ?>