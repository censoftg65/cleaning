<?php
// Initialize the session.
session_start();
include '../inc/config.inc.php';
include '../inc/function.inc.php';
$db = new Config(); 

$log = (isset($_REQUEST['log'])) ? "?log=out" : "?log=none" ;

$u_name = $db->getParam('txtUsername');
$p_word = $db->getParam('txtPassword');

if(USE_PASSWORD_ENCRYPTION) {
	if(USE_PASSWORD_ENCRYPTION == 'base64_encode'){
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