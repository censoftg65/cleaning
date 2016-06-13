<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(dirname(__DIR__)).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();
$site_settings = getSiteConfig();
$book_id = $db->getParam('book_id');
$email = $objCommon->getUser($book_id);
if (!empty($book_id)) {
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = $site_settings[0]['txtSMTPhost'];
	$mail->Port = $site_settings[0]['txtSMTPport'];
	$mail->SMTPAuth = true;
	$mail->Username = $site_settings[0]['txtSMTPuname'];
	$mail->Password = $site_settings[0]['txtSMTPpword'];
	$mail->SMTPSecure = '';

	$mail->From = $site_settings[0]['txtRegMailFrom'];
	$mail->FromName = $site_settings[0]['txtSMTPfromname'];
	$mail->addAddress($email[0]['txtEmail'], '');
	$mail->isHTML(true);
	$mail->Subject = 'Cancel Service';
	$mail->Body = 'Thank you..!<br><br>
					Your request for cancel the respective service has been initiated.<br><br> 
					Our representative will contact you soon and explain you the further process i.e. to restart the <br>
					service again or refund the amount.<br><br> 
					We will happy to give you a service again and again and will keep update you about new offers.<br><br>
					Thanks & Regards,<br>
					Unwritten Cleaning<br>
					USA';
	$mail->send();
	
	$objCommon->cancelServices($book_id);
	$data = array('message' => 'Your request has been initiated.', 'error' => 'yes');
	$output = json_encode($data);
 	echo $output;
}

$db->freeResult();
$db->close();

?>