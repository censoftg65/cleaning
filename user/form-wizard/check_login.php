<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
include_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
$db = new Config(); 

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

$user_login = getUserLogin($u_name,$p_word,"user");
if (empty($user_login)) {
	header("location:"._SITE_URL."/user/my_profile.php");	
} else {
	header("location:"._SITE_URL."/user/login.php".$log."&msg=1");	
}

?>