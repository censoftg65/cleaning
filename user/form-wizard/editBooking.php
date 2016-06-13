<?php
// Initialize the session.
session_start();
ob_start();

$uid = $_SESSION["txtId"];

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(dirname(__DIR__)).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();
$site_settings = getSiteConfig();
$email = displayName(_DB_PREFIX.'user','txtEmail',$uid,'txtId');
$user = displayDoubleName(_DB_PREFIX.'user','txtFirstname','txtLastName',$uid,'txtId');

$ookId = $db->getParam('hidBookId');
$arr_book['txtBedroom'] 		= $db->getParam('txtBedroom');
$arr_book['txtBathroom'] 		= $db->getParam('txtBathroom');
$arr_book['txtExtraService']	= implode(",", $db->getParam('txtExtraService'));
$arr_book['txtServiceDate'] 	= $db->getParam('txtServiceDate');
$arr_book['txtServiceTime'] 	= $db->getParam('txtServiceTime');
$arr_book['txtServiceHours'] 	= $db->getParam('txtServiceHours');
$arr_book['txtExtraServiceHrs'] = $db->getParam('txtExtraServiceHrs');
$arr_book['txtServiceTip'] 		= $db->getParam('txtServiceTip');
$arr_book['txtRecurring'] 		= $db->getParam('txtRecurring');
$arr_book['txtServiceAmt'] 		= $db->getParam('hidServiceAmt');
$arr_book['txtExtraServiceAmt'] = $db->getParam('txtExtraServiceAmt');

$tot_amt = $arr_book['txtServiceAmt'] + $arr_book['txtExtraServiceAmt'] + $arr_book['txtServiceTip'];
if (empty($arr_book['hidPromoOffer']) || ($arr_book['hidPromoOffer'] == 0)) {
    $dis_tot = 0;   
} else {
    $dis_tot = ($tot_amt  * $arr_book['hidOfferPrice']) / 100;
}
$grand_tot = $tot_amt - $dis_tot;

$arr_book['txtTotalAmt'] 	= $tot_amt;
$arr_book['txtGrandTotal'] 	= $grand_tot;

$objCommon->setBooking($arr_book);

foreach ($site_settings as $setMail) {
	$mail = new PHPMailer();
	$mail2 = clone $mail;
	$mail->isSMTP();
	$mail->Host = $setMail['txtSMTPhost'];
	$mail->Port = $setMail['txtSMTPport'];
	$mail->SMTPAuth = true;
	$mail->Username = $setMail['txtSMTPuname'];
	$mail->Password = $setMail['txtSMTPpword'];
	$mail->SMTPSecure = '';

	$mail->From = $setMail['txtRegMailFrom'];
	$mail->FromName = $setMail['txtSMTPfromname'];
	$mail->addAddress($email, '');
	$mail->isHTML(true);
	$mail->Subject = 'Edit Service Booking - UNWC';
	$mail->Body =  '<b>THANK YOU..!</b><br><br>
					You just edited your booked service with your cleaning professional!<br><br>
					We are happy to serve you. Hope you enjoy our professional cleaning service.<br><br>
					Thanks & Regards,<br>
					Unwritten Cleaning<br>
					USA';
	$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
	$mail->send();
	
	$mail2->FromName = $setMail['txtSMTPfromname'];
	$mail2->AddAddress('censoftg36@gmail.com','Admin Mail');
	$mail2->Subject = 'Edit Service Booking - UNWC';
	$mail2->Body = 'User <b>'.strtoupper($user).'</b> has just edit booked cleaning service.<br><br>
					So please check the service parameters properly.<br><br>
					Thanks & Regards,<br>
					Unwritten Cleaning<br>
					USA';
	$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
	$mail2->Send();
}

$objCommon->getUpdateBooking($ookId);
echo "	<b>THANK YOU..!</b>
		<br> 
		As you have edited your cleaning service.
		<br>
		So our representative will contact you as per your updated time.
		<br>
		We hope you will enjoy our <b>CLEANING PROCESS</b>.";

$db->freeResult();
$db->close();

?>