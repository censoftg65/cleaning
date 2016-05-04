<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
    header("location:index.php");
}

if(session_destroy()) {
    header("location:index.php");
}
session_write_close();

?>