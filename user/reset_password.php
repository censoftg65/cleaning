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
require_once dirname(__DIR__).'/inc/function.inc.php';
include_once dirname(__DIR__).'/pages/cls_pages.php';
include_once 'cls_user.php';
$_SESSION['page_title'] = "Reset Password | "._SITE_NAME;
$db = new Config(); 

$key = $db->getParam('key');
$uname = $db->getParam('uname');

$chk_user = $objUser->checkUserKey($key);
$chkUser = $chk_user[0];
$uid = $chkUser['txtUserId'];

$coll_status = $objUser->getResetkey($key,$uid);
$collStatus = $coll_status[0];

if (empty($key) && empty($uname)) {
    header('location:'._SITE_URL.'/');
    exit();
} else {
    if ($collStatus['txtStatus'] == 1) {
        $suc_msg = "PLEASE PROVIDE NEW PASSWORD TO UPDATE<br>";
        $suc_msg .= "NEW PASSWORD WILL WORK AFTER UPDATING FROM OLD ONE";
    } else {
        $err_msg = "YOUR RESET PASSWORD LINK HAS EXPIRED<br>";
        $err_msg .= "YOU CAN APPLY AGAIN TO RESET YOUR PASSWORD";
    }
}

?>

<?php include dirname(__DIR__).'/includes/header.php';?>

<body class="inner">
    <div id="wrapper">
        
        <?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
        
        <div style="margin-top:200px !important;"></div>
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_form">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-centered">
                    <h2><strong>Reset Password</strong></h2>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 log_box">
                <div class="col-md-12">
                    <div id="succ-resp" class="col-md-12 response col-centered"></div>
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6" id="shows">
                        <?php if($collStatus['txtStatus'] == 1) {?>
                        <p class="suc-msg-box"><?= $suc_msg?></p>
                        <?php } else { ?>
                        <p class="err-msg-box"><?= $err_msg?></p>
                        <?php } ?>
                    </div>
                    <div class="col-md-3">&nbsp;</div>
                </div>
                <form name="frmResetPass" id="frmResetPass" method="post">
                    <div class="col-md-3">
                        <input type="hidden" name="hidUserId" id="hidUserId" value="<?= $uid?>">
                        <input type="hidden" name="hidKey" id="hidKey" value="<?= $key?>">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></div>
                                <input class="form-control input-lg" type="password" id="txtPassword" name="txtPassword" value="" required="" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></div>
                                <input class="form-control input-lg" type="password" id="txtConfirmPass" name="txtConfirmPass" value="" required="" placeholder="Repeat Password">
                            </div>
                        </div>
                        <div>&nbsp;</div>

                        <div class="form-group pull-left">
                            <div>
                                Have an account? 
                                <a href="<?= _SITE_URL?>/user/login.php">Click here</a>
                            </div>
                            <div>
                                Forgot password?
                                <a href="<?= _SITE_URL?>/user/forgot_password.php">Click here</a>
                            </div>
                        </div>
                        <div class="form-group card-actionbar-row pull-right">
                            <?php if($collStatus['txtStatus'] == 1) {?>
                            <button type="button" class="btn btn-lg btn-primary" id="btnResetPass" name="btnResetPass">
                                <span style="display:none" id="reg_user_loading"></span>&nbsp;Update Password
                            </button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-lg btn-primary" disabled="">Update Password</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </form>
            </div>
        </div>
        
    </div>   

    <?php include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
    
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>