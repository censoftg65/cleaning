<?php
session_start();

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

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
include 'cls_pages.php';
$db = new Config(); 
$coolection = $objPage->getPageContent();

$page_entity = $db->getParam('pagename');
$_SESSION['page_title'] = ucfirst($page_entity)." | "._SITE_NAME;

?>

<?php include dirname(__DIR__).'/includes/header.php' ?>

<body class="inner">
    <div id="wrapper">

		<?php include dirname(__DIR__).'/includes/header-menu.php' ?>

		<!-- <div style="margin-top:200px !important;"></div> -->

		<?php
        foreach ($coolection as $page) {
		    if ($page['txtPageEntity'] ==  $page_entity) {
        		echo $page["txtSliderContent"] 
        ?>
        
		<div id="main-content">
	    	<div class="container page-container">
	        	<div class="row">
	        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        			<div class="col-md-6">
							<h2><?= $page['txtPageTitle']?></h2>
						</div>
						<div class="col-md-12"><hr></div>
						<div class="col-md-12 page-content">
							<?= $page['txtTextContent']?>
						</div>
						<div class="col-md-12">&nbsp;</div>
	        		</div>
				</div>
			</div>
		</div>			
        <?php 
            }
        }    
        ?>

	</div>	

	<?php include dirname(__DIR__).'/includes/footer-upper-grid.php' ?>

<?php include dirname(__DIR__).'/includes/footer.php'; ?>