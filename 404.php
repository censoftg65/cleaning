<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
    header("location:index.php");
}

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$mail = $_SESSION["txtEmail"];
$utype = $_SESSION["txtUserType"];
$ulevel= $_SESSION["txtUserLevel"];

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page Not Found | FitTean</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,800,700italic,700,800italic" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/global.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>

<body>
<div class="dashbord">
    <div>
      <div class="error-404 text-center">
        <i class="fa fa-frown-o"></i>
        <h1>Whooops!</h1>
        <h4>We couldn't find the page you are looking for...</h4>
        <p>
            or 
            <?php if ($ulevel == "SuperAdmin") { ?>
            <a href="super-admin/dashboard.php">get back to home page</a>
            <?php } elseif ($ulevel == "Admin") { ?>
            <a href="admin/dashboard.php">get back to home page</a>
            <?php } elseif ($ulevel == "Trainer") { ?>
            <a href="trainer/dashboard.php">get back to home page</a>
            <?php } else { ?>
            <a href="index.php">get back to home page</a>
            <?php } ?>
        </p>
      </div> 
    </div>
</div>

<!-- Custome Script Adding-->
<script type="text/javascript" src="js/script_common.js"></script>

</body>
</html>