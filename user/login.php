<?php
session_start();

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
$_SESSION['page_title'] = "Login | "._SITE_NAME;
$db = new Config(); 

$log = (isset($_REQUEST['log'])) ? "out" : "";
$msg = (isset($_REQUEST['msg'])) ? $_REQUEST['msg'] : "";

?>

<?php include dirname(__DIR__).'/includes/header.php'; ?>

<body>
    <?php /*include dirname(__DIR__).'/includes/header-menu.php';*/ ?>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-centered alt2 raised">
                        <h2><strong>Login Form</strong></h2>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form name="frmUserLogin" id="frmUserLogin" action="form-wizard/check_login.php" method="post">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 col-centered alt2 raised">
                            <div><h3>Please Login To Your Account</h3></div>
                            <div>&nbsp;</div>
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input class="form-control input-lg" type="text" id="txtUsername" name="txtUsername" value="<?= $db->getParam('txtUsername')?>" required="">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input class="form-control input-lg" type="password" id="txtPassword" name="txtPassword" value="<?= $db->getParam('txtpassword')?>" required="">
                            </div>
                            <?php if($msg == "1") {echo "<span>Invalid Username Or Password..! Please Try Again..!</span>";}?>
                            <div class="form-group pull-right">
                                <input accessKey="s" type="submit" class="btn btn-lg btn-success" name="btnLogin" value="Login here">
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>