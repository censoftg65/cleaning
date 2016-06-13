<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_quiz.php';
$db = new Config();

$applid = $db->getParam('applid');
$sel_chk = $db->getParam('allSelAllp');
$sel_cnt = count($db->getParam('allSelAllp'));

$del_chk = $db->getParam('allDelAllp');
$del_cnt = count($db->getParam('allDelAllp'));
$flag = $db->getParam('flag');

if (!empty($applid) && $flag == 'view') {
	$appli_details = $objQuiz->getApplicationsPreview($applid);
	$application = $appli_details[0];

	echo '<table class="table table-bordered">';
		echo '<tr>';
			echo '<td>First Name</td>';
			echo '<td>'.ucfirst($application["txtFirstName"]).'</td>';
			echo '<td>Last Name</td>';
			echo '<td>'.ucfirst($application["txtLastName"]).'</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>Mail Address</td>';
			echo '<td>'.$application["txtMailingAddr"].'</td>';
			echo '<td>Appartment</td>';
			echo '<td>'.ucfirst($application["txtAppartment"]).'</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>City - Zipcode</td>';
			echo '<td>'.ucfirst($application["txtCity"]).' - '.$application["txtZipcode"].'</td>';
			echo '<td>State</td>';
			echo '<td>'.ucfirst($application["txtState"]).'</td>';
		echo '</tr>';

		echo '<tr>';
			echo '<td>Work Experience</td>';
			echo '<td>'.$application["txtWorkExp"].'</td>';
			echo '<td>How much paid cleaning done?</td>';
			echo '<td>'.$application["txtPaidCleaning"].'</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>How did know about UNWC?</td>';
			echo '<td>'.$application["txtHearAbout"].'</td>';
			echo '<td>Eligible to work in US?</td>';
			echo '<td>'.$work = ($application["txtEligibleToWork"] == "Y") ? "Yes" : "No".'</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>T-Shirt Preference</td>';
			echo '<td>'.$prefer = ($application["txtTshirtPreference"] == "M") ? "Men's" : "Women's".'</td>';
			echo '<td>T-Shirt Size</td>';
			echo '<td>'.$application["txtTshirtSize"].'</td>';
		echo '</tr>';
	echo '</table>';
} elseif (isset($sel_chk) && ($flag == "multitrash")) {
	for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."appl_form SET txtStatus = 0 WHERE txtId = '$id';";
        $db->query($query);
    }
} elseif (isset($del_chk) && ($flag == "multidel")) {
	for($i=0; $i < $del_cnt; $i++) {
        $id = $del_chk[$i];
        $query = "DELETE FROM "._DB_PREFIX."appl_form WHERE txtId = '$id';";
        $db->query($query);
    }
}

$db->freeResult();
$db->close();

?>