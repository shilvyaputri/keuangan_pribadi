<?php
session_start();
require_once "../config/database.php";

$id       = $_POST['id_user'];
$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($password)) {

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("
        UPDATE users
        SET nama = ?, username = ?, password = ?
        WHERE id_user = ?
    ");

    $stmt->execute([
        $nama,
        $username,
        $passwordHash,
        $id
    ]);

} else {

    $stmt = $conn->prepare("
        UPDATE users
        SET nama = ?, username = ?
        WHERE id_user = ?
    ");

    $stmt->execute([
        $nama,
        $username,
        $id
    ]);
}

$_SESSION['user']['nama'] = $nama;

header("Location: ../pages/user/profil.php");
exit;