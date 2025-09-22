<?php
    require 'config.php';
    session_start();

    if (isset($_SESSION['admin'])) {
        $adminId = $_SESSION['admin'];
        $stmt = "SELECT * FROM admin WHERE id = '$adminId'";
        $query = mysqli_query($connect, $stmt);
        $admin = mysqli_fetch_assoc($query);
    }else{
        header('location:login.php');
    }
?>