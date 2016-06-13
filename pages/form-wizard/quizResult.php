<?php

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(dirname(__DIR__)).'/PHPMailer/PHPMailerAutoload.php';
include_once dirname(__DIR__).'/cls_pages.php';
$db = new Config();
$site_settings = getSiteConfig();

$quiz_data = $db->getParam('values');
$odd = array();
$even = array();
foreach ($quiz_data as $k => $v) {
    if ($k % 2) {
        $even[] = $v;
    } else {
        $odd[] = $v;
    }
}
$arr_data = array_combine($odd, $even);

$right = $wrong = 0;
foreach ($arr_data as $key => $value) {
	$sql = "SELECT txtQuizId,txtAnswer FROM "._DB_PREFIX."quiz_ans WHERE txtQuizId = '$key' AND txtAnswer = '".addslashes($value)."';";
	$db->query($sql);
	$numRow = $db->numRows();
	if ($numRow > 0) {
		$ansAry[] = array($key,"Right");
		$right++;
	} else {
		$ansAry[] = array($key,"Wrong");
		$wrong++;
	}
}
// echo "R = ".$right." W = ".$wrong;

$form_data = $db->getParam('formdata');
$formdata = array();
parse_str($form_data, $formdata);

$arr_appl["txtFirstName"]		= $formdata["txtFirstName"];
$arr_appl["txtLastName"]		= $formdata["txtLastName"];
$arr_appl["txtMailingAddr"]		= $formdata["txtMailingAddr"];
$arr_appl["txtAppartment"]		= $formdata["txtAppartment"];
$arr_appl["txtCity"]			= $formdata["txtCity"];
$arr_appl["txtState"]			= $formdata["txtState"];
$arr_appl["txtZipcode"]			= $formdata["txtZipcode"];
$arr_appl["txtWorkExp"]			= $formdata["txtWorkExp"];
$arr_appl["txtPaidCleaning"]	= $formdata["txtPaidCleaning"];
$arr_appl["txtHearAbout"]		= $formdata["txtHearAbout"];
$arr_appl["txtEligibleToWork"]	= $formdata["txtEligibleToWork"];
$arr_appl["txtTshirtPreference"]= $formdata["txtTshirtPreference"];
$arr_appl["txtTshirtSize"]		= $formdata["txtTshirtSize"];
$arr_appl["txtAgreeTerms"]		= $formdata["txtAgreeTerms"];
$arr_appl["hidQueCount"]		= $formdata["hidQueCount"];

if (checkAppl($arr_appl["txtMailingAddr"]) == 0) {
	$objPage->setDetails($arr_appl);

	$eligible = ($arr_appl["txtEligibleToWork"] == "Y") ? "Yes" : "No";
	$prefer = ($arr_appl["txtTshirtPreference"] == "M") ? "Male" : "Female";

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
		$mail->addAddress('censoftg100@gmail.com', 'Admin Mail');
		$mail->isHTML(true);
		$mail->Subject = 'New Application To Become A Cleaning Professional - UNWC';
		$mail->Body =  'Hi there,<br><br>
						User '.$arr_appl["txtFirstName"].'&nbsp;'.$arr_appl["txtLastName"].' has fill up the application form along with the <b>QUIZ</b> to become a Cleaning Professional.<br><br>
						<table width="700" cellspacing="0" cellpadding="0" border="0" style="border-left:1px solid #ccc;border-top:1px solid #ccc;font-family:Arial;font-size:14px">
							<tr>
								<td bgcolor="#666" align="center" colspan="4" style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;"><b><font size="5" color="#fff">Applicant Profile Details</font></b></b></td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">First Name</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtFirstName"].'</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Last Name</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtLastName"].'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Mail Address</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtMailingAddr"].'</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Appartment</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtAppartment"].'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">City</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.ucfirst($arr_appl["txtCity"]).'</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">State</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtState"].'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Zipcode</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;" colspan="3">'.$arr_appl["txtZipcode"].'</td>
							</tr>
							<tr><td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;" colspan="4">&nbsp;</td></tr>
							<tr><td bgcolor="#666" align="center" colspan="4" style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;"><b><font size="5" color="#fff">Other Details</font></b></b></td></tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Work Experience</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtWorkExp"].'</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">How many paid cleanings done</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtPaidCleaning"].'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">How to hear about UNWC</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtHearAbout"].'</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Eligible to work in US</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$eligible.'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">T-Shirt Preference</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$prefer.'</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">T-Shirt Size</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["txtTshirtSize"].'</td>
							</tr>
						</table>
						<br>
						<table width="700" cellspacing="0" cellpadding="0" border="0" style="border-left:1px solid #ccc;border-top:1px solid #ccc;font-family:Arial;font-size:14px">
							<tr>
								<td bgcolor="#666" align="center" colspan="4" style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;"><b><font size="5" color="#fff">Quiz Result</font></b></b></td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Total Question</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$arr_appl["hidQueCount"].'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Correct Anwers</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$right.'</td>
							</tr>
							<tr>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">Incorrect Anwers</td>
								<td style="border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:5px 10px;color:#303030;">'.$wrong.'</td>
							</tr>
						</table>
						<br><br>
						Please go through with the user profile and initialize hiring process.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail->send();
		
		$mail2->FromName = $setMail['txtSMTPfromname'];
		$mail2->AddAddress($arr_appl["txtMailingAddr"],'User Mail');
		$mail2->Subject = 'Application For Cleaning Professional - UNWC';
		$mail2->Body = 'Dear '.$arr_appl["txtFirstName"].'&nbsp;'.$arr_appl["txtLastName"].',<br><br>
						<b>Thank You!</b><br><br>
						This mail is regarding to inform that your have successfully applied to become a cleaning professional<br>
						through Unwritten Cleaning.<br><br>
						As the process is just started, our management team will go through your profile and the quiz score,<br>
						accordingly you will get to know the status of your application form.<br><br>
						Thanks & Regards,<br>
						Unwritten Cleaning<br>
						USA';
		$mail2->AltBody = 'This is the system generated mail, so please do not reply on it.';
		$mail2->Send();
	}
	$objPage->insertApplication();
	echo "	<b>THANK YOU..!</b>
			<br> 
			You have successfully submitted the the application to become a cleaning professional.
			<br>
			We hope you will join our <b>CLEANING PROFESSIONAL TEAM</b>.";
} else {
	echo "	<b>SORRY..!</b>
			<br> 
			You have already submitted application with us. Our management team will contact you for status.
			<br>
			We hope you will join our <b>CLEANING PROFESSIONAL TEAM</b>.";
}	

$db->freeResult();
$db->close();

?>