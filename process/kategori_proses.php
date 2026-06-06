<?php
require_once "../config/database.php";

// TAMBAH
if (isset($_POST['tambah'])) {

    $stmt = $conn->prepare("INSERT INTO kategori (nama_kategori, id_jt)
                            VALUES (?, ?)");
    $stmt->execute([
        $_POST['nama_kategori'],
        $_POST['id_jt']
    ]);

    header("Location: ../pages/kategori/index.php");
}

// UPDATE
if (isset($_POST['update'])) {

    $stmt = $conn->prepare("UPDATE kategori SET nama_kategori=?, id_jt=? WHERE id_kategori=?");
    $stmt->execute([
        $_POST['nama_kategori'],
        $_POST['id_jt'],
        $_POST['id_kategori']
    ]);

    header("Location: ../pages/kategori/index.php");
}

// HAPUS
if (isset($_GET['hapus'])) {

    $stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori=?");
    $stmt->execute([$_GET['hapus']]);

    header("Location: ../pages/kategori/index.php");
}