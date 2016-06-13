<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$name = $_SESSION["txtFirstName"]." ".$_SESSION["txtLastName"];
//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value) {
    if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

require_once dirname(__DIR__).'/inc/config.inc.php';
require_once dirname(__DIR__).'/inc/function.inc.php';
include_once dirname(__DIR__).'/PHPMailer/PHPMailerAutoload.php';
include_once 'cls_common.php';
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/user/");
}

$_SESSION['page_title'] = "Payment Process | "._SITE_NAME;
$db = new Config(); 

include dirname(__DIR__).'/includes/head.php';

try {	
	require_once('Stripe.php');
	Stripe::setApiKey("sk_test_0rx5dxCCn0JEJiiojwVIIf9i"); //Replace with your Secret Key
	
	$charge = Stripe_Charge::create(array(
		"amount" => $db->getParam('grandtot')."00",
		"currency" => "usd",
		"card" => $db->getParam('stripeToken'),
		"description" => "Test Transaction"
	));
	
	//send the file, this line will be reached if no error was thrown above
	$site_settings = getSiteConfig();
	$email = displayName(_DB_PREFIX.'user','txtEmail',$uid,'txtId');
	$user = displayDoubleName(_DB_PREFIX.'user','txtFirstname','txtLastName',$uid,'txtId');

	$arr_book['txtOrderId']			= $db->getParam('orderid');
	$arr_book['txtUserId']			= $_SESSION['txtId'];
	$arr_book['txtBedroom'] 		= $db->getParam('bedroom');
	$arr_book['txtBathroom'] 		= $db->getParam('bathrrom');
	$arr_book['txtExtraService']	= $db->getParam('ex-service');
	$arr_book['txtServiceDate'] 	= $db->getParam('servicedate');
	$arr_book['txtServiceTime'] 	= $db->getParam('servicetime');
	$arr_book['txtServiceHours'] 	= $db->getParam('servicehrs');
	$arr_book['txtExtraServiceHrs'] = $db->getParam('ex-servicehrs');
	$arr_book['txtServiceTip'] 		= $db->getParam('servicetip');
	$arr_book['txtRecurring'] 		= $db->getParam('recurring');
	$arr_book['txtPromoCode'] 		= $db->getParam('promo');
	$arr_book['txtPromoOffer'] 		= $db->getParam('offerprice');
	$arr_book['txtServiceAmt'] 		= $db->getParam('serviceamt');
	$arr_book['txtExtraServiceAmt'] = $db->getParam('ex-serviceamt');
	$arr_book['txtTotalAmt'] 		= $db->getParam('totamt');
	$arr_book['txtGrandTotal'] 		= $db->getParam('grandtot');

	$objCommon->setBooking($arr_book);
	pr($arr_book);

	foreach ($site_settings as $setMail) {
		$mail = new PHPMailer();
		$mail2 = clone $mail;
		$mail3 = clone $mail;
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
		$mail->Body =  '<b>THANK YOU..!</b><br><br>
						You just booked our cleaning professional services!<br><br>
						You are a valuable customer to us, so please let us review your booked service and get you a great permanent<br>
						cleaning professional.<br><br>
						We are very happy to serve you and hope you will enjoy our professional service.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->send();
		
		$mail2->FromName = $setMail['txtSMTPfromname'];
		$mail2->AddAddress($email,'User Mail');
		$mail2->Subject = 'Payment Confirmation - UNWC';
		$mail2->Body = 'Dear User ,<br>
						This mail is regarding to inform that your have paid the amount $'.$arr_book['txtGrandTotal'].' for UNWC professional<br>
						and your payment has been done successfully.<br><br>
						Once the UNWC professional will check the payment and what service you required they will contact<br>
						you for futher process.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail2->Send();

		$mail3->FromName = $setMail['txtSMTPfromname'];
		$mail3->AddAddress('censoftg36@gmail.com','Admin Mail');
		$mail3->Subject = 'New Service Booking - UNWC';
		$mail3->Body = 'User <b>'.strtoupper($user).'</b> has booked a new cleaning service.<br><br>
						So please check the service parameters properly.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail3->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail3->Send();
	}

	$objCommon->insertBooking();
	header("location:success.php?flag=".base64_encode("success"));
	// echo $db->getParam('stripeEmail');

} catch(Stripe_CardError $e) {
	header("location:success.php?flag=".base64_encode("failed"));
}

//catch the errors in any way you like

catch (Stripe_InvalidRequestError $e) {
  // Invalid parameters were supplied to Stripe's API

} catch (Stripe_AuthenticationError $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

} catch (Stripe_ApiConnectionError $e) {
  // Network communication with Stripe failed
} catch (Stripe_Error $e) {

  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {

  // Something else happened, completely unrelated to Stripe
}
?>