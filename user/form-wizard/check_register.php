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

$arr_user['txtUsername'] 	= strtolower($db->getParam('txtFirstName').$db->getParam('txtLastName'));
$password = randomPassword();
$arr_user['txtPassword'] 	= base64_encode($password);
$arr_user['txtFirstName']   = $db->getParam('txtFirstName');
$arr_user['txtLastName']    = $db->getParam('txtLastName');
$arr_user['txtAddressLine1']= $db->getParam('txtAddressLine1');
$arr_user['txtAddressLine2']= $db->getParam('txtAddressLine2');
$arr_user['txtCountry']     = $db->getParam('txtCountry');
$arr_user['txtState']       = $db->getParam('txtState');
$arr_user['txtCity']        = $db->getParam('txtCity');
$arr_user['txtZipcode']     = $db->getParam('txtZipcode');
$arr_user['txtEmail']       = $db->getParam('txtEmail');
$arr_user['txtPhone']       = $db->getParam('txtPhone');
$arr_user['txtIpAddress']   = $ip_address;

if (checkUser($arr_user['txtEmail']) == 0) {
	$objUser->setDetails($arr_user);
	
	$reg_body = explode(' ', $site_settings[0]['txtRegBody']);
	$u_key = array_search('[user_name]',$reg_body);
	$p_key = array_search('[pass_word]',$reg_body);
	$reg_body[$u_key] = $arr_user['txtUsername'];
	$reg_body[$p_key] = $password;
	$register_body = implode(' ',$reg_body);

	$reg_adminbody = explode(' ', $site_settings[0]['txtRegAdminBody']);
	$name_key = array_search('[user_full_name]',$reg_adminbody);
	$mail_key = array_search('[user_mail_id]',$reg_adminbody);
	$num_key = array_search('[user_phone_num]',$reg_adminbody);
	$reg_adminbody[$name_key] = $arr_user['txtFirstName']." ".$arr_user['txtLastName'];
	$reg_adminbody[$mail_key] = $arr_user['txtEmail'];
	$reg_adminbody[$num_key] = $arr_user['txtPhone'];
	$register_adminbody = implode(' ',$reg_adminbody);

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
	$mail->addReplyTo($site_settings[0]['txtSMTPrplymail'], 'Information');
	$mail->addCC($site_settings[0]['txtSMTPccmail']);
	$mail->addBCC($site_settings[0]['txtSMTPbccmail']);
	$mail->WordWrap = 50;
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
	$mail->isHTML(true);
	$mail->Subject = $site_settings[0]['txtRegSub'];
	$mail->Body    = $register_body;
	$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
	$mail->send();

	$mail2->FromName = $site_settings[0]['txtSMTPfromname'];
	$mail2->AddAddress('censoftg37@gmail.com','Admin Mail');
	$mail2->Subject = $site_settings[0]['txtRegSub'];
	$mail2->Body = $register_adminbody;
	$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
	$mail2->Send();
	
	$objUser->insertDetails();
	$data = array('message' => 'Your registration successfully done. Please check your mail for account details.', 'success' => 'yes');
	$output = json_encode($data);
    echo $output;
} else {
	$data = array('message' => 'User already registered with us. Please try again..!', 'success' => 'no');
	$output = json_encode($data);
    echo $output;
}

$db->freeResult();
$db->close();

?>