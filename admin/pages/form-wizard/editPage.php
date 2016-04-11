<?php
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 

$pageId = $db->getParam('pageid');
$arr_page['txtPageTitle']       = $db->getParam('editPagetitle');
$arr_page['txtPageUrl']         = $db->getParam('editPageurl');
$arr_page['txtSliderContent']   = mysql_real_escape_string($db->getParam('editSlidercontent'));
$arr_page['txtTextContent']     = mysql_real_escape_string($db->getParam('editTextcontent'));

$setDetails = $objPage->setDetails($arr_page);
$execute = $objPage->updatePage($pageId);

?>