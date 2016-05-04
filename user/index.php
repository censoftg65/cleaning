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
require_once dirname(__DIR__).'/inc/function.inc.php';
include_once dirname(__DIR__).'/pages/cls_pages.php';
include_once 'cls_user.php';
$_SESSION['page_title'] = "Login | "._SITE_NAME;
$db = new Config(); 

$log = (isset($_REQUEST['log'])) ? "out" : "";
$msg = (isset($_REQUEST['msg'])) ? $_REQUEST['msg'] : "";

?>

<?php include dirname(__DIR__).'/includes/header.php'; ?>

<body class="inner">
    <div id="wrapper">
        
        <?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
        
        <div style="margin-top:200px !important;"></div>
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_form">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-centered">
                    <h2><strong>Login Form</strong></h2>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 log_box">
                <form name="frmUserLogin" id="frmUserLogin" action="form-wizard/check_login.php" method="post">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-centered">
                        <div><h4><strong>Please login into your account</strong></h4></div>
                        
                        <?php if($msg == "1") {echo "<span>Invalid Username Or Password..! Please Try Again..!</span>";}?>
                        
                        <div>&nbsp;</div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                                <input class="form-control input-lg" type="text" id="txtUsername" name="txtUsername" value="<?= $db->getParam('txtUsername')?>" required="" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></div>
                                <input class="form-control input-lg" type="password" id="txtPassword" name="txtPassword" value="<?= $db->getParam('txtpassword')?>" required="" placeholder="Password">
                            </div>
                        </div>
                        <div>&nbsp;</div>

                        <div class="form-group pull-left">
                            <div>
                                Forgot password?
                                <a href="<?= _SITE_URL?>/user/forgot_password.php">Click here</a>
                            </div>
                            <div>
                                Not a member yet?
                                <a href="<?= _SITE_URL?>/user/register.php">Click here</a>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <input accessKey="s" type="submit" class="btn btn-lg btn-primary" name="btnLogin" value="Login Here">
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </form>
            </div>
        </div>
        
    </div>   

    <?php include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
    
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>