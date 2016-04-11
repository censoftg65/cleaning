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

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
$_SESSION['page_title'] = "Dashboard | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 

$log = (isset($_REQUEST['log'])) ? "out" : "";
$msg = (isset($_REQUEST['msg'])) ? $_REQUEST['msg'] : "";

$ad_logged = (isset($_SESSION['ad_logged'])) ? $_SESSION['ad_logged'] : false;
if($ad_logged == true) {
	$left_menu_page = "left_menu.php";
	$content_page = "home.php";
} else {
	$left_menu_page = "left_menu_empty.php";
	$content_page = "login.php";
}
  
?>

<?php include 'include/header.php' ?>

  <?php include 'include/left_menu.php' ?>

  <div class="col-md-9">
    <h4>WELCOME TO THE ADMIN SECTION</h4>
  </div>

  <?php include 'include/footer.php' ?>