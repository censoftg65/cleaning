<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
require dirname(dirname(dirname(__DIR__))).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_users.php';
$db = new Config();
$site_settings = getSiteConfig();

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

if ($db->getParam('user_edit_value') == "Editrecord") {
	$user_id = $db->getParam('edit_users');
	$setDetails = $objUser->setDetails($arr_user);
	$execute = $objUser->updateUser($user_id);
	$data = array('message' => "User profile updated successfully.", 'success' => 'update');
	$output = json_encode($data);
	echo $output;
} else {
	if (checkUser($arr_user['txtEmail']) == 0) {
		$reg_body = explode(' ', $site_settings[0]['txtRegBody']);
		$u_key = array_search('[user_name]',$reg_body);
		$p_key = array_search('[pass_word]',$reg_body);
		$reg_body[$u_key] = $arr_user['txtUsername'];
		$reg_body[$p_key] = $arr_user['txtPassword'];
		$register_body = implode(' ',$reg_body);

		$reg_adminbody = explode(' ', $site_settings[0]['txtRegAdminBody']);
		$name_key = array_search('[user_full_name]',$reg_adminbody);
		$mail_key = array_search('[user_mail_id]',$reg_adminbody);
		$num_key = array_search('[user_phone_num]',$reg_adminbody);
		$reg_adminbody[$name_key] = $arr_user['txtFirstName']." ".$arr_user['txtFirstName'];
		$reg_adminbody[$mail_key] = $arr_user['txtEmail'];
		$reg_adminbody[$num_key] = $arr_user['txtPhone'];
		$register_adminbody = implode(' ',$reg_adminbody);

		$setDetails = $objUser->setDetails($arr_user);
		
		$mail = new PHPMailer();
		$mail2 = clone $mail;
		$mail->isSMTP();
		$mail->Host = $site_settings[0]['txtSMTPhost'];
		$mail->Port = $site_settings[0]['txtSMTPport'];
		$mail->SMTPAuth = true;
		$mail->Username = $site_settings[0]['txtSMTPuname'];
		$mail->Password = $site_settings[0]['txtSMTPpword'];
		$mail->SMTPSecure = '';	
		$mail->From = $site_settings[0]['txtRegMailFrom'];
		$mail->FromName = $site_settings[0]['txtSMTPfromname'];
		$mail->addAddress($arr_user['txtEmail'], '');
		$mail->addBCC($site_settings[0]['txtSMTPbccmail']);
		$mail->WordWrap = 100;
		$mail->addAttachment('/var/tmp/file.tar.gz');
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
		$mail->isHTML(true);
		$mail->Subject = $site_settings[0]['txtRegSub'];
		$mail->Body    = $register_body;
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->Send();
		
		$mail2->FromName = $site_settings[0]['txtSMTPfromname'];
		$mail2->AddAddress('censoftg100@gmail.com','Admin Mail');
		$mail2->Subject = $site_settings[0]['txtRegSub'];
		$mail2->Body = $register_adminbody;
		$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail2->Send();
		
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