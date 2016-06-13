<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_pages.php';
$db = new Config();

$mailaddr = $db->getParam("email");
if (checkAppl($mailaddr) != 0) {
	$data = array('message' => "Mail address already available. Please try again..!", 'error' => 'no');
	$output = json_encode($data);
	echo $output;
} else {
	$data = array('message' => "Mail address not available.", 'error' => 'yes');
	$output = json_encode($data);
	echo $output;
}

$db->freeResult();
$db->close();

?>