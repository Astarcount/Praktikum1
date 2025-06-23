<?php
session_start();
$index = $_GET["kunci"];
unset($_SESSION["daftar"][$index]);
header("location: dashboard.php");
?>