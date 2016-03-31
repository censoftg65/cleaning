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

require_once(dirname(dirname(__DIR__)).'/inc/config.inc.php');
include(dirname(dirname(__DIR__)).'/inc/function.inc.php');
include 'cls_pages.php';
$db = new Config(); 
$objPage = new Pages(); 
$pid = base64_decode($db->getParam('pid'));

if (!empty($pid)) {
    $update_page = $objPage->getPageDetails("edit",$pid);
    $page = $update_page[0];
}

?>

<head>
    <title><?php echo _SITE_NAME ?> :: Pages | Add Pages</title>
</head>

<?php include '../include/header.php' ?>

<?php include '../include/left_menu.php' ?>

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form name="frmAddPages" id="frmAddPages" method="post">
                <div class="col-md-12"><h4><strong>EDIT PAGE</strong></h4></div>
                <input type="hidden" name="hidPageId" id="hidPageId" value="<?= $pid?>">
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Page Title : </label>
                        <input class="form-control input-sm" type="text" id="txtEditPageTitle" name="txtEditPageTitle" value="<?= $page['txtPageTitle']?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Page Url Link : </label>
                        <input class="form-control input-sm" type="text" id="txtEditPageUri" name="txtEditPageUri" value="<?= $page['txtPageUrl']?>" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Page Content</label>
                        <textarea class="form-control" id="txtEditPageContent" name="txtEditPageContent" rows="10"><?= $page['txtPageContent']?></textarea> 
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-md btn-success" name="btnUpdatePage" id="btnUpdatePage">
                        <span style="display:none" id="edit_loading"></span>&nbsp;&nbsp;Update Page
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../include/footer.php' ?>