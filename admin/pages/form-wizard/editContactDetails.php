<?php
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 

$contactid = $db->getParam('contactid');
$arr_page['txtTitle'] 			= $db->getParam('title');
$arr_page['txtContactDetails'] 	= $db->getParam('contactDetail');

$setDetails = $objPage->setDetails($arr_page);
$execute = $objPage->updateContactDetails($contactid);

?>