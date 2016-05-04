<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"]; 

include '../inc/config.inc.php';
include '../inc/function.inc.php';
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$log = (isset($_REQUEST['log'])) ? "?log=out" : "?log=none" ;

$u_name = $db->getParam('txtUsername');
$p_word = $db->getParam('txtPassword');

if(_USE_PASSWORD_ENCRYPTION) {
	if(_USE_PASSWORD_ENCRYPTION == 'base64_encode'){
		$p_word = base64_encode($p_word);
	} else {
		$p_word = '(\''.$p_word.'\')';
	}
} else {
	$p_word = '\''.$p_word.'\'';
}

$ad_login = getLogin($u_name,$p_word,"admin");
if (empty($ad_login)) {
	header("location:dashboard.php");	
} else {
	header("location:index.php".$log."&msg=1");	
}

?>