<?php
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 
$objPage = new Pages(); 

$pageId = $db->getParam('pageid');
$pageTitle = $db->getParam('editPagetitle');
$pageUrl = $db->getParam('editPageurl');
$pageContent = mysql_real_escape_string($db->getParam('editPagecontent'));

$sql_update = "UPDATE "._DB_PREFIX."pages SET txtPageTitle = '$pageTitle',
                                              txtPageUrl = '$pageUrl',
                                              txtPageContent = '$pageContent'
                                        WHERE txtId = '$pageId'";
$result = $db->query($sql_update);

?>