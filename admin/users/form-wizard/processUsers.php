<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
require dirname(dirname(dirname(__DIR__))).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_users.php';
$db = new Config();

$verifyCode = rand();
$username = strtolower($db->getParam('txtFirstName')."".$db->getParam('txtLastName'));
$password = randomPassword();

$arr_user['txtEmail'] 		= $db->getParam('txtEmail');
$arr_user['txtUsername'] 	= $username;
$arr_user['txtPassword'] 	= $password;
$arr_user['txtFirstName'] 	= $db->getParam('txtFirstName');
$arr_user['txtLastName'] 	= $db->getParam('txtLastName');
$arr_user['txtAddressLine1']= $db->getParam('txtAddressLine1');
$arr_user['txtAddressLine2']= $db->getParam('txtAddressLine2');
$arr_user['txtCountry']		= $db->getParam('txtCountry');
$arr_user['txtState'] 		= $db->getParam('txtState');
$arr_user['txtCity'] 		= $db->getParam('txtCity');
$arr_user['txtZipcode']		= $db->getParam('txtZipcode');
$arr_user['txtPhone'] 		= $db->getParam('txtPhone');
$arr_user['txtUserLevel'] 	= $db->getParam('txtUserLevel');
$arr_user['txtIpAddress'] 	= $ip_address;
$arr_user['txtStatus'] 		= $db->getParam('txtStatus');

if ($db->getParam('form_edit_value') == "Editrecord") {
	$user_id = $db->getParam('edit_users');
	$setDetails = $objUser->setDetails($arr_user);
	$execute = $objUser->updateUser($user_id);
	echo "User profile updated successfully";
} else {
	if (checkUser($arr_user['txtEmail']) == 0) {
		$setDetails = $objUser->setDetails($arr_user);
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = 'mail.centurysoftwares.com';
		$mail->Port = '25';
		$mail->SMTPAuth = true;
		$mail->Username = 'centurys';
		$mail->Password = 'PYUkj47@$[]M$!M';
		$mail->SMTPSecure = '';

		$mail->From = 'info@unwrittencleaning.com';
		$mail->FromName = 'Unwritten Cleaning';
		$mail->addAddress($arr_user["txtEmail"], '');
		$mail->addReplyTo('info@example.com', 'Information');
		$mail->addBCC('censoftg100@gmail.com');
		$mail->WordWrap = 50;
		$mail->addAttachment('/var/tmp/file.tar.gz');
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
		$mail->isHTML(true);
		$mail->Subject = 'New User Registration';
		$mail->Body    = '<b>Thank you for registering on UNWRITTEN CLEANING.</b><br><br>
						  Your login details are : <br><br>
						  <b>
						  Username : <span>'.$arr_user['txtUsername'].'</span><br>
						  Password : <span>'.$arr_user['txtPassword'].'</span>
						  </b>
						  <br><br>
						  Please click on below mentioned link to activate your account.<br><br>
		                  http://centurysoftwares.com/cleaning/user/login.php?virifycode='.base64_encode($verifyCode).'&mail='.base64_encode($arr_user["txtEmail"]).'<br><br>
		                  <br><br>
		                  <b>
		                  Thanks & Regards,<br>
		                  Unwritten Cleaning
		                  </b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();

		$execute = $objUser->insertUser();
		$data = array('message' => "User profile created successfully.", 'success' => 'yes');
		$output = json_encode($data);
	    echo $output;
	} else {
		$data = array('message' => "User already register with us. Please try again..!", 'success' => 'no');
		$output = json_encode($data);
	    echo $output;
	}
}

?>