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

include '../inc/config.inc.php';
include '../inc/function.inc.php';
$db = new Config(); 

// check if previouse name was saved
$username = (isset($_COOKIE['remember_name']) && ($_COOKIE['remember_name'] != "")) ? strip_tags($_COOKIE['remember_name']) : "";
$remember_me    = (isset($_COOKIE['remember_name']) && ($_COOKIE['remember_name'] != "")) ? "checked" : "";

$log = (isset($_REQUEST['log'])) ? "out" : "";
$msg = (isset($_REQUEST['msg'])) ? $_REQUEST['msg'] : "";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
    <title><?php echo _SITE_NAME?> :: Admin Panel</title>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <link href="<?php echo _SITE_URL?>css/style_<?php echo _CSS_STYLE?>.css" type=text/css rel=stylesheet>
    <link href="<?php echo _SITE_URL?>bootstrap/css/bootstrap.min.css" type=text/css rel=stylesheet>
    <link href="<?php echo _SITE_URL?>bootstrap/css/bootstrap-theme.min.min.css" type=text/css rel=stylesheet>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<div class="container">
    <div class="row row-centered">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form name="frmLogin" id="frmLogin" action="check_login.php" method="post">
        <!-- <form name="frmLogin" id="frmLogin" method="post"> -->
            <input type="hidden" value="login" name="do">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-centered alt2 raised">
                <h4>LOG-IN HERE</h4>
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
                    <input accessKey="s" type="submit" class="btn btn-md btn-success" name="btnLogin" value="Login" onClick="rememberMe(); return onSubmitCheck(document.forms['frmLogin'], false,false);">
                </div>
            </div>
            <div class="col-md-4"></div>
        </form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javaScript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javaScript" src="<?php echo _SITE_URL?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javaScript" src="<?php echo _SITE_URL?>js/script_custom.js"></script>
<script>
document.getElementById("txtUsername").focus();
function rememberMe(val) {
    if(document.getElementById("txtRemember").checked == true) {
        setCookie("remember_name",document.getElementById("txtUsername").value,14);       
    } else {
        setCookie("remember_name","",-2);       
    }
}
</script>