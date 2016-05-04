<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_offers.php';
$db = new Config();

$arr_offer['txtPromoCode']	= $db->getParam('txtPromoCode');
$arr_offer['txtOffer']  	= $db->getParam('txtOffer');
$arr_offer['txtOfferTaken'] = $db->getParam('txtOfferTaken');

$setDetails = $objOffers->setDetails($arr_offer);
$execute1 = $objOffers->createOffers();
$execute2 = $objOffers->userOffer($arr_offer['txtOfferTaken']);

?>