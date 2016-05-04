<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$arr_book['txtUserId']			= $_SESSION['txtId'];
$arr_book['txtBedroom'] 		= $db->getParam('brdroom');
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
$arr_book['txtTotal'] 			= $db->getParam('totamt');
$arr_book['txtExtraServiceAmt'] = $db->getParam('ex-serviceamt');
$arr_book['txtGrandTotal'] 		= $db->getParam('grandtot');

$objCommon->setBooking($arr_book);
$objCommon->insertBooking();
echo "	Thank you for choosing our cleaning process.<br> 
		Our cleaning process representative will contact you shortly.<br> 
		Hope you are going to enjoy our cleaning process.";

$db->freeResult();
$db->close();

?>