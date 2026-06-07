<?php
session_start();
require_once "../config/database.php";

// TAMBAH USER
if (isset($_POST['tambah'])) {

    $nama     = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_role  = $_POST['id_role'];

    $stmt = $conn->prepare("
        INSERT INTO users
        (nama, username, password, id_role)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $nama,
        $username,
        $password,
        $id_role
    ]);

    header("Location: ../pages/admin/user/index.php");
    exit;
}

// UPDATE USER
if (isset($_POST['update'])) {

    $id_user  = $_POST['id_user'];
    $nama     = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $id_role  = $_POST['id_role'];

    // Jika password diisi
    if (!empty($_POST['password'])) {

        $password = password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        );

        $stmt = $conn->prepare("
            UPDATE users
            SET
                nama = ?,
                username = ?,
                password = ?,
                id_role = ?
            WHERE id_user = ?
        ");

        $stmt->execute([
            $nama,
            $username,
            $password,
            $id_role,
            $id_user
        ]);

    } else {

        $stmt = $conn->prepare("
            UPDATE users
            SET
                nama = ?,
                username = ?,
                id_role = ?
            WHERE id_user = ?
        ");

        $stmt->execute([
            $nama,
            $username,
            $id_role,
            $id_user
        ]);
    }

    header("Location: ../pages/admin/user/index.php");
    exit;
}

// HAPUS USER
if (isset($_GET['hapus'])) {

    $id_user = $_GET['hapus'];

    $stmt = $conn->prepare("
        DELETE FROM users
        WHERE id_user = ?
    ");

    $stmt->execute([$id_user]);

    header("Location: ../pages/admin/user/index.php");
    exit;
}