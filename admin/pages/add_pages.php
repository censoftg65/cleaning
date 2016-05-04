<?php
session_start();
ob_start();

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
$_SESSION['page_title'] = "Add Menus | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

    <?php include dirname(__DIR__).'/include/left_menu.php' ?>

    <div class="col-md-9">
        <div class="col-lg-12"><h4><strong>ADD PAGE</strong></h4></div>
        <form name="frmAddPages" id="frmAddPages" method="post">
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Page Title : </label>
                    <input class="form-control input-sm" type="text" id="txtPageTitle" name="txtPageTitle" value="">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Slider Content</label>
                    <textarea class="form-control" id="txtPageSliderContent" name="txtPageSliderContent"></textarea> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Text Content</label>
                    <textarea class="form-control" id="txtPageTextContent" name="txtPageTextContent"></textarea> 
                </div>
            </div>

            <div class="col-md-12 extract-div">
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-md btn-success" name="btnCreatePage" id="btnCreatePage">
                            <span style="display:none" id="loading"></span>&nbsp;&nbsp;Create Page
                        </button>
                    </div>
                </div>
                <div class="col-md-6 open-up-msg">
                    <div class="form-group">
                        <div id="page-success" title="Thank you" style="display: none">
                            Page has been created successfully.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include dirname(__DIR__).'/include/footer.php' ?>