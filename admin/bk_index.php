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

<?php include 'include/header.php' ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-md-12">
        <form name="frmLogin" id="frmLogin" action="check_login.php" method="post">
            <input type="hidden" value="login" name="do">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-centered alt2 raised">
                <h4>LOGIN HERE</h4>
                <div>
                    <label>Username / Email</label>
                    <input class="form-control" type="text" id="txtUsername" name="txtUsername" value="<?php echo $db->getParam('txtUsername')?>" required="">
                </div>
                <br>
                <div>
                    <label>Password</label>
                    <input class="form-control" type="password" id="txtPassword" name="txtPassword" value="<?php echo $db->getParam('txtpassword')?>" required="">
                </div>
                <br>
                <div>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="txtRemember" name="txtRemember" value="1" <?php echo $remember_me?> title="Remember Me">
                        <small>Remember me</smal>
                    </label>
                </div>
                <br>
                <?php if(!empty($error)) { echo $error; } ?>
                <?php if($msg == "1") { echo "<span class='msg_error'>Invalid Username Or Password..! <br>Please Try Again..!</span>"; } ?>
                <br>
                <div>
                    <input accessKey="s" type="submit" class="btn btn-primary" name="btnLogin" value="Login" onClick="rememberMe(); return onSubmitCheck(document.forms['frmLogin'], false,false);">
                </div>
            </div>
            <div class="col-md-4"></div>
        </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php' ?>