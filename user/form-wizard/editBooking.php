<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$ookId = $db->getParam('hidBookId');
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
$objCommon->getUpdateBooking($ookId);
echo "	<b>THANK YOU..!</b>
		<br> 
		As you have updated your cleaning service.
		<br>
		So our representative will contact you as per your updated time.
		<br>
		We hope you will enjoy our <b>CLEANING PROCESS</b>.";

$db->freeResult();
$db->close();

?>