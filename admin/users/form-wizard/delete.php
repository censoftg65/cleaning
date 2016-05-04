<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_users.php';
$db = new Config();

$sel_chk = $db->getParam('allSelect');
$sel_cnt = count($db->getParam('allSelect'));
$status = $db->getParam('status');

if (isset($sel_chk) && ($status == "moveAll")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."user SET txtStatus = 1 WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "deleteAll")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."user SET txtStatus = 'delete' WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "delAllActUser")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."user SET txtStatus = 'delete' WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "activeAll")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "UPDATE "._DB_PREFIX."user SET txtStatus = '1' WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
} elseif (isset($sel_chk) && ($status == "deleteAllPer")) {
    for($i=0; $i < $sel_cnt; $i++) {
        $id = $sel_chk[$i];
        $query = "DELETE FROM "._DB_PREFIX."user WHERE txtId = '$id';";
        $execute = $db->query($query);
    }
}


?>