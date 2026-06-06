<?php
$host = "localhost";
$db   = "keuangan_pribadi";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}