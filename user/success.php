<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$name = $_SESSION["txtFirstName"]." ".$_SESSION["txtLastName"];
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

$_SESSION['page_title'] = "Success | "._SITE_NAME;
$db = new Config(); 

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 succ-content">
                    <?php 
                    $flag = base64_decode($db->getParam("flag"));
                    if ($flag == "success") {
                    ?>
                    <div class="jumbotron">
                        <div class="alert alert-success" role="alert">
                            <h1>THANK YOU..!</h1>
                            <p> 
                                You have booked a service for our cleaning professional.
                                Our cleaning process representative will contact you shortly.<br><br>
                                We hope you will enjoy our <b>CLEANING PROCESS</b>.
                            </p>
                            <p>&nbsp;</p>
                            <p><a class="btn btn-primary btn-lg" href="pending_services.php" role="button">Go To Booking Services</a></p>
                        </div>
                    </div>
                    <?php } 
                    if ($flag == "failed") {
                    ?>
                    <div class="jumbotron">
                        <div class="alert alert-success" role="alert">
                            <h1>SORRY..!</h1>
                            <p> 
                                Your booking services not booked yet.
                                Some error has been occured due to server slow or incorrect card details.<br><br>
                                Please contact admin for better assistance of <b>CLEANING PROCESS</b>.
                            </p>
                            <p>&nbsp;</p>
                            <p><a class="btn btn-primary btn-lg" href="pending_services.php" role="button">Go To Booking Services</a></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>

    <!-- Confirm Booking Success Meaasgae Start -->
    <div style="display:none" id="back-color"></div>
    <div style="display:none" class="modal-dialog" id="success-preview">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
    <!-- Confirm Booking Success Meaasgae End -->
