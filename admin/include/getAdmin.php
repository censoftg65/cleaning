<?php
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
include_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_classes.php';
$db = new Config();

$user_id = $db->getParam('user_id');
$db->query("SELECT * FROM "._DB_PREFIX."user WHERE txtId = '$user_id'");
$row = $db->fetchAssoc();
$output = json_encode($row);
print_r($output);

?>