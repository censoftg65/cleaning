<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:/cleaning/admin/index.php");
}

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
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

require_once (dirname(dirname(__DIR__)).'/inc/config.inc.php');
include_once (dirname(dirname(__DIR__)).'/inc/function.inc.php');
include_once 'cls_pages.php';
$_SESSION['page_title'] = "Footer Contact Details | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
$contactId = "1";

if (!empty($contactId)) {
    $contact_details = $objPage->getContactDetails($contactId);
    $contact = $contact_details[0];    
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

    <?php include dirname(__DIR__).'/include/left_menu.php' ?>

    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div class="col-md-12"><h4><strong>CONTACT DETAILS</strong></h4></div>
        <form name="frmContactDetails" id="frmContactDetails" method="post">
            <div class="col-md-12">&nbsp;</div>
            <input type="hidden" id="hidContactId" name="hidContactId" value="<?= $contactId?>">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title : </label>
                    <input type="text" class="form-control input-sm" id="txtTitle" name="txtTitle" value="<?= $contact['txtTitle']?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Contact Details</label>
                    <textarea class="form-control" id="txtEditContactDetails" name="txtEditContactDetails"><?= $contact['txtContactDetails']?></textarea> 
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-md btn-success" name="btnContactDetails" id="btnContactDetails">
                    <span style="display:none" id="contact_loading"></span>&nbsp;&nbsp;Update Contact Details
                </button>
            </div>
        </form>
    </div>

    <?php include dirname(__DIR__).'/include/footer.php' ?>