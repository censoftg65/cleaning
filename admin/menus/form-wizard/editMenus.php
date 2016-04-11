<?php
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 

$menuId = $db->getParam('menuId');
$menuTitle = $db->getParam('menuTitle');
$menuParent = $db->getParam('menuParent');
$menuUrl = $db->getParam('menuUrl');
$menuIcon = $db->getParam('menuIcon');

$sql_query = "UPDATE "._DB_PREFIX."menus SET txtParentId    = '$menuParent',
                                             txtMenu        = '$menuTitle',
                                             txtMenuUrl     = '$menuUrl',
                                             txtMenuIcon    = '$menuIcon'
                                       WHERE txtId = '$menuId'";
$result = $db->query($sql_query);

?>