<?php
session_start();
require_once "../config/database.php";

// LOGIN
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = [
            'id'   => $user['id_user'],
            'nama' => $user['nama'],
            'role' => $user['id_role']
        ];

        // Redirect sesuai role
        if ($user['id_role'] == 1) {

            // ADMIN
            header("Location: ../pages/admin/dashboard.php");

        } else {

            // USER
            header("Location: ../pages/user/dashboard.php");

        }

        exit;

    } else {

        echo "
        <script>
            alert('Username atau Password salah!');
            window.location='../auth/login.php';
        </script>
        ";

        exit;
    }
}

// LOGOUT
if (isset($_GET['logout'])) {

    session_destroy();

    header("Location: ../auth/login.php");
    exit;
}