<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$name  = $_SESSION["txtFirstName"]." ".$_SESSION["txtLastName"];
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
include_once 'cls_common.php';

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/user/");
}

$_SESSION['page_title'] = "Notification | "._SITE_NAME;
$db = new Config(); 

$objCommon->clearUserNotification($uid);
$notify_coll = $objCommon->getNotifications($uid);

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <section>
    	<div class="container contentMain">
            <div class="row">

            	<?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>

                <div class="col-sm-9 contentPart">
                    <div class="col-sm-12">
                        <h2 class="compHead">My Notifications</h2>
                    </div>
                    
                    <div class="col-sm-12 table-responsive">
                        <form name="frmNotification" id="frmNotification" method="post">
                            <?php 
                            foreach ($notify_coll as $notify) {
                                if ($notify['txtStatus'] == 1) {
                            ?>
                            <div class="list-group">
                                <a class="list-group-item">
                                    <h4 class="list-group-item-heading"><b><?= $notify["txtPromoCode"]?></b></h4>
                                    <p class="list-group-item-text text-desc">Use above promo code for getting a discount of on your booking services.</p>
                                </a>
                            </div>
                            <?php 
                                } 
                            } 
                            ?>
                            <?php if (empty($notify_coll)) { ?>
                            <div class="list-group">
                                <a class="list-group-item">
                                    <h4 class="list-group-item-heading not-avail">Sorry..! Notification not available.</h4>
                                </a>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>
