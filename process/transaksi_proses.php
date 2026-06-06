<?php
session_start();
require_once "../config/database.php";

// TAMBAH
if (isset($_POST['tambah'])) {

    $stmt = $conn->prepare("
        INSERT INTO transaksi (id_user, id_kategori, nominal, tanggal, keterangan)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_SESSION['user']['id'],
        $_POST['id_kategori'],
        $_POST['nominal'],
        $_POST['tanggal'],
        $_POST['keterangan']
    ]);

    header("Location: ../pages/transaksi/index.php");
}

// UPDATE
if (isset($_POST['update'])) {

    $stmt = $conn->prepare("
        UPDATE transaksi 
        SET id_kategori=?, nominal=?, tanggal=?, keterangan=?
        WHERE id_transaksi=?
    ");

    $stmt->execute([
        $_POST['id_kategori'],
        $_POST['nominal'],
        $_POST['tanggal'],
        $_POST['keterangan'],
        $_POST['id_transaksi']
    ]);

    header("Location: ../pages/transaksi/index.php");
}

// HAPUS
if (isset($_GET['hapus'])) {

    $stmt = $conn->prepare("DELETE FROM transaksi WHERE id_transaksi=?");
    $stmt->execute([$_GET['hapus']]);

    header("Location: ../pages/transaksi/index.php");
}