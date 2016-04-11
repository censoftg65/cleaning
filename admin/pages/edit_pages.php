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
$_SESSION['page_title'] = "Edit Menus | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
$pid = base64_decode($db->getParam('pid'));

if (!empty($pid)) {
    $update_page = $objPage->getPageDetails("edit",$pid);
    $page = $update_page[0];
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

    <?php include dirname(__DIR__).'/include/left_menu.php' ?>

    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div class="col-md-12"><h4><strong>EDIT PAGE</strong></h4></div>
        <form name="frmAddPages" id="frmAddPages" method="post">
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
                    <label>Slider Content</label>
                    <textarea class="form-control" id="txtEditSliderContent" name="txtEditSliderContent"><?= $page['txtSliderContent']?></textarea> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Text Content</label>
                    <textarea class="form-control" id="txtEditTextContent" name="txtEditTextContent"><?= $page['txtTextContent']?></textarea> 
                </div>
            </div>

            <div class="col-md-12">
                <button type="button" class="btn btn-md btn-success" name="btnUpdatePage" id="btnUpdatePage">
                    <span style="display:none" id="edit_loading"></span>&nbsp;&nbsp;Update Page
                </button>
            </div>
        </form>
    </div>

    <?php include dirname(__DIR__).'/include/footer.php' ?>