<?php
session_start();
$_SESSION['status']="Logout Successfully.";
$_SESSION['status_code']="success";
header('Location:index.php');
?>