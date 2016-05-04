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

$email = $db->getParam('txtEmail');
$chk_mail = $objUser->checkResetEmail($email);

if ($chk_mail == 0) {
	$data = array('message' => 'User with this email address is not registered with us. Please provide valid email address.', 'error' => 'no');
	$output = json_encode($data);
    echo $output;
} else {
	$arr_user['txtResetKey'] = md5(microtime().rand());
	$user_data = explode(' ',displayDoubleName(_DB_PREFIX.'user','txtId','txtUsername',$email,'txtEmail'));
	$arr_user['txtUserId'] = $user_data[0];
	$uname = $user_data[1];
	$forpass_body = explode(' ', $site_settings[0]['txtForgotBody']);
	$u_key = array_search('[user_name]',$forpass_body);
	$pass_key = array_search('[reset_pass_link]',$forpass_body);
	$forpass_body[$u_key] = $uname;
	$forpass_body[$pass_key] = _SITE_URL.'/user/reset_password.php?key='.$arr_user['txtResetKey'].'&uname='.$uname;
	$for_pass_body = implode(' ',$forpass_body);

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = $site_settings[0]['txtSMTPhost'];
	$mail->Port = $site_settings[0]['txtSMTPport'];
	$mail->SMTPAuth = true;
	$mail->Username = $site_settings[0]['txtSMTPuname'];
	$mail->Password = $site_settings[0]['txtSMTPpword'];
	$mail->SMTPSecure = '';

	$mail->From = $site_settings[0]['txtForgotMailFrom'];
	$mail->FromName = $site_settings[0]['txtSMTPfromname'];
	$mail->addAddress($email, '');
	$mail->addReplyTo($site_settings[0]['txtSMTPrplymail'], 'Information');
	$mail->addCC($site_settings[0]['txtSMTPccmail']);
	$mail->addBCC($site_settings[0]['txtSMTPbccmail']);
	$mail->WordWrap = 50;
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
	$mail->isHTML(true);
	$mail->Subject = $site_settings[0]['txtForgotSub'];
	$mail->Body    = $for_pass_body;
	$mail->send();

	$objUser->setResetDetails($arr_user);
	$objUser->insertResetPass();
	$data = array('message' => 'Thanks for your request. Please check your mail for further process.', 'error' => 'yes');
	$output = json_encode($data);
    echo $output;
}

$db->freeResult();
$db->close();

?>