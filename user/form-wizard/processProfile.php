<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$arr_profile['hidUserId']   = $db->getParam('hidUserId');
$arr_profile['txtFirstName']   = $db->getParam('txtFirstName');
$arr_profile['txtLastName']    = $db->getParam('txtLastName');
$arr_profile['txtPhone']       = $db->getParam('txtPhone');
$arr_profile['txtAddressLine1']= $db->getParam('txtAddressLine1');
$arr_profile['txtAddressLine2']= $db->getParam('txtAddressLine2');
$arr_profile['txtCountry']     = $db->getParam('txtCountry');
$arr_profile['txtState']       = $db->getParam('txtState');
$arr_profile['txtCity']        = $db->getParam('txtCity');
$arr_profile['txtZipcode']     = $db->getParam('txtZipcode');

$setVar = $objCommon->setDetails($arr_profile);
$objCommon->updateProfile($arr_profile['hidUserId']);
header("location:"._SITE_URL."/user/my_profile.php");
$db->freeResult();
$db->close();

?>