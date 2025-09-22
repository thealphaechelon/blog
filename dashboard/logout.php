<?php
    require 'includes/session.php';
   if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        header('location:login.php');
   }
?>