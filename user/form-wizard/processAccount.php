<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config();

$user_id = $db->getParam('hidUserId');
$old_pass = base64_encode($db->getParam('txtPassword'));
$new_pass = base64_encode($db->getParam('txtNewPassword'));
$status = $db->getParam('rdoStatus');
$old_match = displayName(_DB_PREFIX.'user','txtPassword',$user_id,'txtId');

if (empty($new_pass) && empty($status)) {
	$data = array('message' => "You have nothing to update now.", 'status' => 'null');
	$output = json_encode($data);
	echo $output;
} elseif (empty($new_pass) && !empty($status)) {
	if ($status == 1) {
		$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtStatus = 1 WHERE txtId = '$user_id'");
		$data = array('message' => "Your account status updated successfully", 'status' => 'stat_yes');
		$output = json_encode($data);
		echo $output;
	} else {
		$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtStatus = 0 WHERE txtId = '$user_id'");
		$data = array('message' => "Your account is no longer activate. Once log out you won't be able to login again.", 'status' => 'stat_no');
		$output = json_encode($data);
		echo $output;
	}
} elseif (!empty($new_pass) && empty($status)) {
	if ($old_match == $old_pass) {
		$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtPassword = '$new_pass' WHERE txtId = '$user_id'");
		$data = array('message' => "Your account password updated successfully", 'status' => 'pass_yes');
		$output = json_encode($data);
		echo $output;
	} else {
		$data = array('message' => "Your old password is not match with the present one", 'status' => 'pass_no');
		$output = json_encode($data);
		echo $output;
	} 
} elseif (!empty($new_pass) && !empty($status)) {
	if ($status == 1) {
		if ($old_match == $old_pass) {
			$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtPassword = '$new_pass' WHERE txtId = '$user_id'");
			$data = array('message' => "Your account password & account status updated successfully", 'status' => 'both_yes');
			$output = json_encode($data);
			echo $output;		
		} else {
			$data = array('message' => "Your old password is not match with the present one but account status updated successfully", 'status' => 'one_yes');
			$output = json_encode($data);
			echo $output;
		}
		$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtStatus = 1 WHERE txtId = '$user_id'");
	} else {
		if ($old_match == $old_pass) {
			$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtPassword = '$new_pass' WHERE txtId = '$user_id'");
			$data = array('message' => "Password updated successfully but account is no longer activated. Once log out you won't be able to login again.", 'status' => 'both_no');
			$output = json_encode($data);
			echo $output;
		} else {
			$data = array('message' => "Old password is not match with present and account is no longer activate. Once log out you won't be able to login again.", 'status' => 'one_no');
			$output = json_encode($data);
			echo $output;
		}
		$sql = $db->query("UPDATE "._DB_PREFIX."user SET txtStatus = 0 WHERE txtId = '$user_id'");
	}
}

$db->freeResult();
$db->close();

?>