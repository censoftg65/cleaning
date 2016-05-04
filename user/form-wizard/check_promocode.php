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
if (empty($promo_code)) {
	$data = array('message' => "Invalid Code", 'status' => 'null');
	$output = json_encode($data);
	echo $output;
} else {
	$db->query("SELECT * FROM "._DB_PREFIX."promo_offers WHERE txtPromoCode = '$promo_code' AND txtOfferTaken = '$user_id'");
	$num_rows = $db->numRows();
	if ($num_rows == 0) {
		$data = array('message' => "Invalid Offer", 'status' => 'abcsent');
		$output = json_encode($data);
		echo $output;
	} else {
		$offer = $db->fetchAssoc();
		$user = $offer['txtOfferTaken'];
		$price = $offer['txtOffer'];
		if ($offer['txtStatus'] == 0) {
			$data = array('message' => "Offer already taken", 'status' => 'consume');
			$output = json_encode($data);
			echo $output;
		} else {
			$db->query("UPDATE "._DB_PREFIX."promo_offers SET txtStatus = 0 WHERE txtPromoCode = '$promo_code'");
			$db->query("UPDATE "._DB_PREFIX."user SET txtOfferShare = 0 WHERE txtId = '$user'");
			$data = array('message' => "Offer Applied", 'status' => 'apply', 'offer' => $price);
			$output = json_encode($data, true);
			echo $output;
		}
	}
}

$db->freeResult();
$db->close();

?>