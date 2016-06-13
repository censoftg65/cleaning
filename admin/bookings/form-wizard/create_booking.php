<?php
session_start();
ob_start();

$uid = $_SESSION["txtId"];

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
require dirname(dirname(dirname(__DIR__))).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_bookings.php';
$db = new Config();
$site_settings = getSiteConfig();

if ($db->getParam('hidEditTag') == "Edit Service") {
	$bookId	= $db->getParam('hidBookId');
	$arr_update['txtBedroom']         = $db->getParam('txtBedroom');
	$arr_update['txtBathroom']        = $db->getParam('txtBathroom');
	$arr_update['txtExtraService']    = implode(",", $db->getParam('txtExtraService'));
	$arr_update['txtServiceDate']     = $db->getParam('txtServiceDate');
	$arr_update['txtServiceTime']     = $db->getParam('txtServiceTime');
	$arr_update['txtServiceHours']    = $db->getParam('txtServiceHours');
	$arr_update['txtExtraServiceHrs'] = $db->getParam('txtExtraServiceHrs');
	$arr_update['txtServiceTip']      = $db->getParam('txtServiceTip');
	$arr_update['txtRecurring']       = $db->getParam('txtRecurring');
	$arr_update['txtServiceAmt']	  = $db->getParam('hidServiceAmt');
    $arr_update['txtExtraServiceAmt'] = $db->getParam('txtExtraServiceAmt');
    $arr_update['txtTotalAmt'] = $arr_update['txtServiceAmt'] + $arr_update['txtExtraServiceAmt'] + $arr_update['txtServiceTip'];
	$dis_tot = 0;   
	$arr_update['txtGrandTotal'] = $arr_update['txtTotalAmt'] - $dis_tot;

	$objBooking->setUpdateDetail($arr_update);
	$objBooking->updateBooking($bookId);
	$data = array('message' => "Booking service updated successfully", 'err' => 'update');
	$output = json_encode($data);
	echo $output;
} else {
	$arr_create['txtUserId']          = $db->getParam('rdoUser');
	$arr_create['txtBedroom']         = $db->getParam('txtBedroom');
	$arr_create['txtBathroom']        = $db->getParam('txtBathroom');
	$arr_create['txtExtraService']    = implode(",", $db->getParam('txtExtraService'));
	$arr_create['txtServiceDate']     = $db->getParam('txtServiceDate');
	$arr_create['txtServiceTime']     = $db->getParam('txtServiceTime');
	$arr_create['txtServiceHours']    = $db->getParam('txtServiceHours');
	$arr_create['txtExtraServiceHrs'] = $db->getParam('txtExtraServiceHrs');
	$arr_create['txtServiceTip']      = $db->getParam('txtServiceTip');
	$arr_create['txtRecurring']       = $db->getParam('txtRecurring');
	$arr_create['txtServiceAmt']	  = $db->getParam('hidServiceAmt');
	$arr_create['txtExtraServiceAmt'] = $db->getParam('txtExtraServiceAmt');
	$arr_create['txtTotalAmt'] = $arr_create['txtServiceAmt'] + $arr_create['txtExtraServiceAmt'] + $arr_create['txtServiceTip'];
	$dis_tot = 0;   
	$arr_create['txtGrandTotal'] = $arr_create['txtTotalAmt'] - $dis_tot;

	$objBooking->setCreateDetail($arr_create);
	$email = displayName(_DB_PREFIX.'user','txtEmail',$arr_create['txtUserId'],'txtId');
	$user = displayDoubleName(_DB_PREFIX.'user','txtFirstname','txtLastName',$arr_create['txtUserId'],'txtId');

	foreach ($site_settings as $setMail) {
		$mail = new PHPMailer();
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
		$mail->Subject = 'New Service Booking - UNWC';
		$mail->Body =  '<b>Hello, '.$user.'</b><br><br>
						Our admin user just booked a cleaning professional service for you.<br><br>
						As you are a valuable customer for us, so please take a time to go through your booked service.<br><br>
						Our professional representative will contact you very shortly and he/she will assist you for the <br>
						further process to follow.<br><br>
						We will very happy to serve you a good service and we hope that you will going to enjoy our professional<br>
						service.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->send();
	}

	$objBooking->createBooking();
	$data = array('message' => "Booking service created successfully", 'err' => 'create');
	$output = json_encode($data);
	echo $output;
}

?>