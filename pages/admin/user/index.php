<?php
require_once "../../../includes/auth.php";
require_once "../../../config/database.php";
cekRole(1);

include "../../../includes/header.php";

// ambil data user + role
$stmt = $conn->query("
    SELECT users.*, role.nama_role 
    FROM users 
    JOIN role ON users.id_role = role.id_role
");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Manajemen User</h3>

    <a href="form.php" class="btn btn-primary mb-3">+ Tambah User</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($users as $u): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $u['nama'] ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['nama_role'] ?></td>
                <td>
                    <a href="form.php?id=<?= $u['id_user'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="../../../process/user_proses.php?hapus=<?= $u['id_user'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../../../includes/footer.php"; ?>