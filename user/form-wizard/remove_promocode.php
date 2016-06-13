<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$promo_code = $db->getParam('promo_code');
$user_id = $_SESSION['txtId'];

if (!empty($promo_code)) {
	$db->query("SELECT * FROM "._DB_PREFIX."promo_offers WHERE txtPromoCode = '$promo_code' AND txtOfferTaken = '$user_id'");
	$num_rows = $db->numRows();
	if ($num_rows == 1) {
		$db->query("UPDATE "._DB_PREFIX."promo_offers SET txtStatus = 1 WHERE txtPromoCode = '$promo_code' AND txtOfferTaken = '$user_id'");
		$db->query("UPDATE "._DB_PREFIX."user SET txtOfferShare = 1 WHERE txtId = '$user_id'");
		$data = array('message' => "Offer Removed", 'status' => 'remove');
		$output = json_encode($data, true);
		echo $output;
	}
} else {
	$data = array('message' => "Service Cancel", 'status' => 'cancel');
	$output = json_encode($data, true);
	echo $output;
}

$db->freeResult();
$db->close();

?>