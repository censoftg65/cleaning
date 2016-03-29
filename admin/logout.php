<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
    header("location:login.php");
}

if(session_destroy()) {
    header("location:../mind-online/index.php");
}
?>