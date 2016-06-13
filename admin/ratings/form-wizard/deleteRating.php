<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_rating.php';
$db = new Config();

$sel_chk = $db->getParam('selAllRate');
$sel_cnt = count($db->getParam('selAllRate'));
$flag = $db->getParam('flag');

if (isset($sel_chk) && ($flag == "multidel")) {
	for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "DELETE FROM "._DB_PREFIX."rating WHERE txtId = '$id';";
        $db->query($query);
    }
}

$db->freeResult();
$db->close();

?>