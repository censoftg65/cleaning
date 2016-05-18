<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_bookings.php';
$db = new Config();

$sel_chk = $db->getParam('selProcess');
$sel_cnt = count($sel_chk);
$status = $db->getParam('status');

if (isset($sel_chk) && ($status == "deleteAll")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."booking SET txtStatus = 'delete' WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "deletePermanantly")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "DELETE FROM "._DB_PREFIX."booking WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "moveActive")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."booking SET txtStatus = '1' WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
}

?>