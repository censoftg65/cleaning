<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_pages.php';
$db = new Config();

$sel_chk = $db->getParam('allSelPage');
$sel_cnt = count($db->getParam('allSelPage'));
$status = $db->getParam('status');

if (isset($sel_chk) && ($status == "moveAll")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."pages SET txtStatus = 1 WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "deleteAll")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "DELETE FROM "._DB_PREFIX."pages WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "deleteAllActPages")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."pages SET txtStatus = 0 WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
}

?>