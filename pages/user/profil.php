<?php
require_once "../../includes/auth.php";
require_once "../../config/database.php";

cekRole(2);

$id = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

include "../../includes/header.php";
?>

<div class="container">
    <h3>Profil Saya</h3>

    <div class="card mt-3">
        <div class="card-body">

            <form action="../../process/update_profil.php" method="POST">

                <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="<?= $user['nama']; ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           value="<?= $user['username']; ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengubah password
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

            </form>

        </div>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>