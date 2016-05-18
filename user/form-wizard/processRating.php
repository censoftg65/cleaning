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
$arr_rating['txtUserId'] 			= $uid;
$arr_rating['txtBookingId'] 		= $db->getParam('book_id');
$arr_rating['txtServiceProvider'] 	= $db->getParam('txtServiceProvider');
$arr_rating['txtRatingComment'] 	= addslashes($db->getParam('txtRatingComment'));
$arr_rating['txtRating'] 			= $db->getParam('txtRating');

$rate_id = $db->getParam('rate_id');
$arr_rating['txtPreRating'] 		= '';
$ratingEdit = $db->getParam('txtRatingEdit');
if (empty($ratingEdit)) {
	$arr_rating['txtPreRating'] = $db->getParam('rating-input-edit');
} else {
	$arr_rating['txtPreRating'] = $db->getParam('txtRatingEdit');
}

if ($db->getParam('get_edit_rate') == "EditRating") {
	$objCommon->setRating($arr_rating);
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
		$mail->Subject = 'Rate A Service';
		$mail->Body = 'Thank you..!<br><br>
						You just edit your rating with service provider named as <b>'.$arr_rating['txtServiceProvider'].'</b>.<br><br>
						We will happy to give you a service again and again and will keep update you about new offers.<br><br>
						<b>Rating Score : '.$arr_rating['txtPreRating'].' stars</b><br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->send();

		$mail2->FromName = $setMail['txtSMTPfromname'];
		$mail2->AddAddress('censoftg37@gmail.com','Admin Mail');
		$mail2->Subject = 'Rate A Service';
		$mail2->Body = 'User named as <b>'.strtoupper($user).'</b> just updated the rating and comment with service provider named as </br>
						<b>'.strtoupper($arr_rating['txtServiceProvider']).'</b>.<br><br>
						<b>Rating Score : '.$arr_rating['txtPreRating'].' stars</b><br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail2->Send();
	}

	$objCommon->updateRating($rate_id);
	$data = array('message' => 'Your rating updated successfuly.', 'msg' => 'update');
	$output = json_encode($data);
	echo $output;
} else {
	$objCommon->setRating($arr_rating);
	
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
		$mail->Subject = 'Rate A Service';
		$mail->Body = 'Thank you..!<br><br>
						Your just rate a service provider named as <b>'.$arr_rating['txtServiceProvider'].'</b><br><br>
						<b>Rating Score : '.$arr_rating['txtRating'].' stars</b><br><br>
						We will happy to give you a service again and again and will keep update you about new offers.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->send();

		$mail2->FromName = $setMail['txtSMTPfromname'];
		$mail2->AddAddress('censoftg37@gmail.com','Admin Mail');
		$mail2->Subject = 'Rate A Service';
		$mail2->Body = 'User named as <b>'.strtoupper($user).'</b> just put the rating and comment with service provider named as </br>
						<b>'.strtoupper($arr_rating['txtServiceProvider']).'</b>.<br><br>
						<b>Rating Score : '.$arr_rating['txtRating'].' stars</b><br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail2->Send();
	}
	
	$objCommon->insertRating();
	$data = array('message' => 'Your rating submitted successfuly.', 'msg' => 'insert');
	$output = json_encode($data);
	echo $output;
}

$db->freeResult();
$db->close();
?>