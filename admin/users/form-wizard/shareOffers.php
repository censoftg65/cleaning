<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
require dirname(dirname(dirname(__DIR__))).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_users.php';
$db = new Config();
$site_settings = getSiteConfig();

$arr_user['txtPromoCode'] = $db->getParam('txtPromoCode');
$arr_user['txtOffer'] = $db->getParam('txtOffer');
$arr_user['txtOfferTaken'] = $db->getParam('get_user_id');
$user_email = displayName(_DB_PREFIX."user",'txtEmail',$arr_user['txtOfferTaken'],'txtId');

if (!empty($arr_user['txtOfferTaken'])) {
	$setDeatils = $objUser->setOfferDetails($arr_user);
	
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = $site_settings[0]['txtSMTPhost'];
	$mail->SMTPAuth = true;
	$mail->Username = $site_settings[0]['txtSMTPuname'];
	$mail->Password = $site_settings[0]['txtSMTPpword'];
	$mail->SMTPSecure = '';	
	$mail->From = $site_settings[0]['txtOfferMailFrom'];
	$mail->FromName = $site_settings[0]['txtSMTPfromname'];
	$mail->addAddress($user_email, '');
	$mail->addCC = $site_settings[0]['txtSMTPccmail'];
	$mail->addBCC = $site_settings[0]['txtSMTPbccmail'];
	$mail->addReplyTo = $site_settings[0]['txtSMTPrplymail'];
	$mail->WordWrap = 50;
	$mail->addAttachment('/var/tmp/file.tar.gz');
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
	$mail->isHTML(true);
	$mail->Subject = $site_settings[0]['txtOfferSub'];
	$mail->Body    = '<b>COUPON CODE : '.$arr_user['txtPromoCode'].'</b>
					  <br><br>'.$site_settings[0]['txtOfferBody'];
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->send();

	$execute = $objUser->offerUserTaken($arr_user['txtOfferTaken']);
} else {
	echo "Error occured. Please contact admin";
}

?>