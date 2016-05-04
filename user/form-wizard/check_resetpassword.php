<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(dirname(__DIR__)).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_user.php';
$db = new Config();
$site_settings = getSiteConfig();

$user_id = $db->getParam('hidUserId');
$key = $db->getParam('hidKey');
$pass_word = base64_encode($db->getParam('txtPassword'));
$conf_pass = $db->getParam('txtConfirmPass');

if (empty($user_id) && empty($key)) {
	$data = array('message' => 'May reset password link has expired. Please try again with valid link.', 'error' => 'no');
	$output = json_encode($data);
    echo $output;
} else {
	$objUser->updateResetPass($key,$user_id);
	$objUser->updateUserPass($pass_word,$user_id);
	unset($conf_pass);
	$data = array('message' => 'Password has been reset successfully. Try to login with new password used.', 'error' => 'yes');
	$output = json_encode($data);
    echo $output;
}

$db->freeResult();
$db->close();

?>