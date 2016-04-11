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
$collection = $objPage->getWelcomeDetails();

$_SESSION['page_title'] = "Welcome | Unwritten Cleaning";

?>

<?php include 'includes/header.php' ?>

<body class="home">
<div class="introBox">
    <div class="introBoxInner">
        <?php
        foreach ($collection as $welcomeContent) {
            if ($welcomeContent["txtPageEntity"] == "welcome") {
                echo $welcomeContent["txtSliderContent"];
                echo $welcomeContent["txtTextContent"];
            }
        }
        ?>
        <div class="socialBox">
            <a href="#" class="link"></a>
            <a href="#" class="twit"></a>
            <a href="#" class="fb"></a>
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php include 'includes/footer.php' ?>
