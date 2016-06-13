<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_pages.php';
$db = new Config();

$men_size = array("32"=>"34","36"=>"36","38"=>"38","40"=>"40","42"=>"42","44"=>"44","46"=>"46","48"=>"48","50"=>"50","52"=>"52");
$women_size = array("2"=>"2","4"=>"4","6"=>"6","8"=>"8","10"=>"10","12"=>"12","14"=>"14","16"=>"16","18"=>"18");

$gender = $db->getParam('gender');
if ($gender == "M") {
	echo "<option value='0'>-- Select Mens Size --</option>";
	foreach ($men_size as $key => $val) {
		echo "<option value='".$key."'>".$val."</option>";
	}
} elseif ($gender == "F") {
	echo "<option value='0'>-- Select Womens Size --</option>";
	foreach ($women_size as $key => $val) {
		echo "<option value='".$key."'>".$val."</option>";
	}
}

$db->freeResult();
$db->close();

?>