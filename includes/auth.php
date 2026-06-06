<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

// cek role
function cekRole($role) {
    if ($_SESSION['user']['role'] != $role) {
        echo "Akses ditolak!";
        exit;
    }
}