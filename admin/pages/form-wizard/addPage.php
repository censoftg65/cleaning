<?php
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 

$arr_page['txtPageTitle']       = $db->getParam('pagetitle');
$arr_page['txtPageEntity'] 		= strtolower(str_replace(' ', '_', $db->getParam('pagetitle')));
$arr_page['txtPageUrl']         = strtolower(str_replace(' ', '_', $db->getParam('pagetitle')));
$arr_page['txtSliderContent']   = mysql_real_escape_string($db->getParam('pageslidercontent'));
$arr_page['txtTextContent']     = mysql_real_escape_string($db->getParam('pagetextcontent'));
$arr_page['txtStatus']          = '1';

$setDetails = $objPage->setDetails($arr_page);
$execute = $objPage->insertPage();

?>