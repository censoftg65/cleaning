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

$_SESSION['page_title'] = "Home | Unwritten Cleaning";
?>

<?php include 'includes/header.php' ?>

<body class="inner">
<div id="home">
    <div id="wrapper">
        <?php include 'includes/header-menu.php'; ?>
        
        <?php
        foreach ($collection as $pageContent) {
            if ($pageContent["txtPageEntity"] == "home") {
        ?>
        <div class="headerBanner">
        	<img src="images/inner-banner.jpg" alt="Unwritten Cleaning" title="Unwritten Cleaning" />
            <div class="headerBannerMid cmnWidth">
                <div class="bannerTxt">
                    <?php echo $pageContent["txtSliderContent"] ?>
                </div>
        	</div>
        </div>
        <div class="welcomeBox cmnWidth">
            <?php echo $pageContent["txtTextContent"] ?>
        </div>
        <?php 
            }
        }    
        ?>

        <div class="bookBg">
        	<div class="bookInner">
            	<img src="images/book-img.png" alt="Book Cleaning" title="Book Cleaning" />
                <div class="bookTxt">
                	<div class="bookTxtLft">
                    	<h3>BOOK CLEANING</h3>
                        <span>Step One, fill out our booking form</span>
                    </div>
                    <div class="bookTxtRight">
                    	<a href="#">Click Here</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php include 'includes/footer-upper-grid.php'; ?>

<?php include 'includes/footer.php'; ?>