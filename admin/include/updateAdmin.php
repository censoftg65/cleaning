<?php
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
include_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_classes.php';
$db = new Config();

$userId = $db->getParam('get_user');
$edit_value = $db->getParam('form_edit_value');

$arr_admin['txtUsername'] = $db->getParam('username');
$arr_admin['txtPassword'] = $db->getParam('password');
if(_USE_PASSWORD_ENCRYPTION) {
	if(_USE_PASSWORD_ENCRYPTION == 'base64_encode'){
		$arr_admin['txtPassword'] = base64_encode($arr_admin['txtPassword']);
	} else {
		$arr_admin['txtPassword'] = '(\''.$arr_admin['txtPassword'].'\')';
	}
} else {
	$arr_admin['txtPassword'] = '\''.$arr_admin['txtPassword'].'\'';
}

$arr_admin['txtFirstName'] 	 = $db->getParam('firstName');
$arr_admin['txtLastName'] 	 = $db->getParam('lastName');
$arr_admin['txtPhone'] 		 = $db->getParam('phone');
$arr_admin['txtAddressLine1']= $db->getParam('addressLine1');
$arr_admin['txtAddressLine2']= $db->getParam('addressLine2');
$arr_admin['txtCountry'] 	 = $db->getParam('country');
$arr_admin['txtState'] 		 = $db->getParam('state');
$arr_admin['txtCity'] 		 = $db->getParam('city');
$arr_admin['txtZipcode'] 	 = $db->getParam('zipcode');
$arr_admin['txtUserLevel'] 	 = $db->getParam('userLevel');
$arr_admin['txtStatus'] 	 = $db->getParam('status');

if ($edit_value == "Editprofile") {
	$set_details = $objSite->setAdminProfile($arr_admin);
	$execute = $objSite->updateAdminProfile($userId);
} elseif ($edit_value == "Editaccount") {
	$set_details = $objSite->setAdminAccount($arr_admin);
	$execute = $objSite->updateAdminAccount($userId);
} else {
	echo "Error occured! Profile not updated.";
}

?>