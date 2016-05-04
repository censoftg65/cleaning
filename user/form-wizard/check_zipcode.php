<?php
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
include_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
$db = new Config(); 

$city = $db->getParam('city');
$zip_codes = $objCommon->getExactZipCode($city);
echo "<option value=''> -- Select -- </option>";
foreach ($zip_codes as $zipNum) {
	echo "<option value=".$zipNum['txtZip'].">".$zipNum['txtZip']."</option>";
}

?>