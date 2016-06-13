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
		"amount" => number_format($db->getParam('hidTotDiff'))."00",
		"currency" => "usd",
		"card" => $db->getParam('stripeToken'),
		"description" => "Test Transaction"
	));
	
	//send the file, this line will be reached if no error was thrown above
	$site_settings = getSiteConfig();
	$email = displayName(_DB_PREFIX.'user','txtEmail',$uid,'txtId');
	$user = displayDoubleName(_DB_PREFIX.'user','txtFirstname','txtLastName',$uid,'txtId');

	$bookId = $db->getParam('hidBookId');
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
	$arr_book['hidPromoOffer']		= $db->getParam('hidPromoOffer');

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
		$mail->Subject = 'Update Service Booking - UNWC';
		$mail->Body =  '<b>THANK YOU..!</b><br><br>
						You just edited your booked service with your cleaning professional!<br><br>
						We are happy to serve you. Hope you enjoy our professional cleaning service.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->send();
		
		$mail2->FromName = $setMail['txtSMTPfromname'];
		$mail2->AddAddress($email,'User Mail');
		$mail2->Subject = 'Update Payment Confirmation - UNWC';
		$mail2->Body = 'Dear User ,<br>
						This mail is regarding to inform that your have edited your services and paid the extra amount $'.number_format($db->getParam('hidTotDiff')).' for UNWC professional<br>
						and your payment has been done successfully.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail2->Send();

		$mail3->FromName = $setMail['txtSMTPfromname'];
		$mail3->AddAddress('censoftg36@gmail.com','Admin Mail');
		$mail3->Subject = 'Edit Service Booking - UNWC';
		$mail3->Body = 'User <b>'.strtoupper($user).'</b> has just edited their booked cleaning service.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail3->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail3->Send();
	}
	$objCommon->getUpdateBooking($bookId);
	
	header("location:success.php?flag=".base64_encode("success"));
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