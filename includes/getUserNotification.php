<?php
session_start();
ob_start();

$uid = $_SESSION['txtId'];

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
include_once dirname(__DIR__).'/user/cls_common.php';
$db = new Config();

$offer_notify = $objCommon->getDiscountOfferNotify($uid);

if ($db->getParam('count') == 'count') {
	$notty_tot = $offer_notify;
	echo '<li><input type="hidden" name="hidUserNottyTot" id="hidUserNottyTot" value="'.$notty_tot.'"></li>';
	if ($offer_notify != 0):
		echo '<li><a href="'._SITE_URL.'/user/notification.php"><span class="badge">'.$offer_notify.'</span> Discount Offer</a></li>';
	endif;

	if ($offer_notify == 0) {
		echo '<li><a><span class="badge">0</span> Notification not available</a></li>';
	}
} elseif($db->getParam('complete_nitify') == 'complete_nitify') {
	if ($offer_notify != 0):
		echo '<li><a href="'._SITE_URL.'/user/notification.php"><span class="badge">'.$offer_notify.'</span> Discount Offer</a></li>';
	endif;

	if ($offer_notify == 0) {
		echo '<li><a><span class="badge">0</span> Notification not available</a></li>';
	}
}

$db->freeResult();
$db->close();

?>