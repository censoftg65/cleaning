<?php 
session_start();
ob_start();
//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value) {
    if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

require_once 'inc/config.inc.php';
require 'inc/function.inc.php';
require 'pages/cls_pages.php';
$db = new Config(); 
$collection = $objPage->getPageContent();

$_SESSION['page_title'] = "About Us | Unwritten Cleaning";

?>

<?php include 'includes/header.php' ?>

<body class="inner">
<div id="wrapper">
    <?php include 'includes/header-menu.php'; ?>
    
    <?php
    foreach ($collection as $pageContent) {
        if ($pageContent["txtPageEntity"] == "contact") {
            echo $pageContent["txtSliderContent"];
            echo $pageContent["txtTextContent"];
        }
    }    
    ?>
</div>

<?php include 'includes/footer-upper-grid.php'; ?>

<?php include 'includes/footer.php'; ?>