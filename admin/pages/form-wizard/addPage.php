<?php
session_start();
ob_start();

include '../../../inc/config.inc.php';
include '../../../inc/function.inc.php';
include '../cls_pages.php';
$db = new Config(); 
$objPage = new Pages(); 

$pageTitle = $db->getParam('pagetitle');
$pageUrl = $db->getParam('pageurl');
$pageContent = mysql_real_escape_string($db->getParam('pagecontent'));

$sql_query = "INSERT INTO "._DB_PREFIX."pages (
                                                    txtPageTitle,
                                                    txtPageUrl,
                                                    txtPageContent,
                                                    txtPageStatus
                                                )
                                        VALUES (
                                                    '$pageTitle',
                                                    '$pageUrl',
                                                    '$pageContent',
                                                    '1'
                                                )";
$result = $db->query($sql_query);

?>