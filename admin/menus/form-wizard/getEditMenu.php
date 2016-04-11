<?php 
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 

$menu_id = $db->getParam('menu_id');
$sql_query = $db->query("SELECT * FROM "._DB_PREFIX."menus WHERE txtId = '$menu_id'");
$row = $db->fetchAssoc($sql_query);
$output = json_encode($row);
print_r($output);

?> 