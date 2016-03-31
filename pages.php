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

include 'inc/config.inc.php';
include 'inc/function.inc.php';
$db = new Config(); 

?>

<?php include 'includes/header.php' ?>

<div class="container">
    <div class="row row-centered">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form name="frmLogin" id="frmLogin" action="check_login.php" method="post">
        <!-- <form name="frmLogin" id="frmLogin" method="post"> -->
            <input type="hidden" value="login" name="do">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-centered alt2 raised">
                <h1>HOME</h1>
                <br>
                <a href="<?php echo _SITE_URL?>user/login.php">Login</a>
                <br><br>
                <a href="<?php echo _SITE_URL?>user/register.php">Register</a>
                <br><br>
                <a href="<?php echo _SITE_URL?>user/forgot-password.php">Forgot Password</a>
            </div>
            <div class="col-md-4"></div>
        </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>