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

$uid = $_SESSION["txtId"];

include '../inc/config.inc.php';
include '../inc/function.inc.php';
$db = new Config(); 

$log = (isset($_REQUEST['log'])) ? "out" : "";
$msg = (isset($_REQUEST['msg'])) ? $_REQUEST['msg'] : "";

$adm_logged = (isset($_SESSION['adm_logged'])) ? $_SESSION['adm_logged'] : false;
if($adm_logged == true) {
	$left_menu_page = "left_menu.php";
	$content_page = "home.php";
} else {
	$left_menu_page = "left_menu_empty.php";
	$content_page = "login.php";
}
  
?>

<head>
  <title><?php echo _SITE_NAME?> :: Dashboard</title>
</head>

<?php include 'include/header.php' ?>

<?php include 'include/left_menu.php' ?>

<frameset rows="90px,*" FRAMEBORDER="no" FRAMESPACING="0" BORDER="0">
     <frame src="header.php" name="header" scrolling="no">
     <frameset cols="170px,*"  FRAMEBORDER="no" FRAMESPACING="0" BORDER="0">
          <frame src="<?php // echo $left_menu_page; ?>" name="left_menu" scrolling="no">
          <frame src="<?php // echo $content_page; ?>" name="frameMain">
     </frameset>
</frameset>

<?php include 'include/footer.php' ?>