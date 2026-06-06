<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
} else {

    if ($_SESSION['user']['role'] == 1) {
        header("Location: pages/admin/dashboard.php");
    } else {
        header("Location: pages/dashboard.php");
    }
}
exit;