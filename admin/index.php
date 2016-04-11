<?php
session_start();
ob_start();
//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value) {
    if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
$_SESSION['page_title'] = "Login | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 

// check if previouse name was saved
$username = (isset($_COOKIE['remember_name']) && ($_COOKIE['remember_name'] != "")) ? strip_tags($_COOKIE['remember_name']) : "";
$remember_me    = (isset($_COOKIE['remember_name']) && ($_COOKIE['remember_name'] != "")) ? "checked" : "";

$log = (isset($_REQUEST['log'])) ? "out" : "";
$msg = (isset($_REQUEST['msg'])) ? $_REQUEST['msg'] : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_SESSION['page_title']?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?= _ADMIN_CSS_ASSETS?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= _ADMIN_CSS_ASSETS?>/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= _ADMIN_CSS_ASSETS?>/css/form-elements.css">
    <link rel="stylesheet" href="<?= _ADMIN_CSS_ASSETS?>/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Javascript -->
    <script src="<?= _ADMIN_CSS_ASSETS?>/js/jquery-1.11.1.min.js"></script>
    <script src="<?= _ADMIN_CSS_ASSETS?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= _ADMIN_CSS_ASSETS?>/js/jquery.backstretch.min.js"></script>
    <script src="<?= _ADMIN_CSS_ASSETS?>/js/scripts.js"></script>
</head>

<body>
<div class="top-content">
	<div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Admin</strong> Login Form</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                	<div class="form-top">
                		<div class="form-top-left">
                			<h3>Login to your admin panel</h3>
                            <p>
                            <?php if($msg == "1") {echo "<span>Invalid Username Or Password..! Please Try Again..!<span>";}?>
                            </p>
                    	</div>
                		<div class="form-top-right">
                			<i class="fa fa-key"></i>
                		</div>
                    </div>
                    <div class="form-bottom">
	                    <form name="frmLogin" id="frmLogin" action="check_login.php" method="post">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-username">Username</label>
	                        	<input type="text" name="txtUsername" placeholder="Username..." class="form-username form-control" id="txtUsername">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-password">Password</label>
	                        	<input type="password" name="txtPassword" placeholder="Password..." class="form-password form-control" id="txtPassword">
	                        </div>
                            <button type="submit" name="btnLogin" class="btn">Sign In!</button>
	                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>