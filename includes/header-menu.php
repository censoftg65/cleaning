<?php  
/* 
*  This file for header menu section
*/
// session_start();
// ob_start();

/*this include header menu section*/
require_once dirname(__DIR__).'/inc/config.inc.php';
$db = new Config(); 

$home_cls = ($_SERVER['REQUEST_URI'] == '/cleaning/home.php') ? "active" : "";
$about_cls = ($_SERVER['REQUEST_URI'] == '/cleaning/about.php') ? "active" : "";
$cleaning_cls = ($_SERVER['REQUEST_URI'] == '/cleaning/pages/pages.php?pagename=cleaning_professional') ? "active" : "";


?>	
	<div class="headerMenu">
        <div class="headerMenuMid">
			<ul>
            	<li><a href="<?= _SITE_URL?>/index.php">Welcome</a></li>
                <li class="<?= $home_cls?>"><a href="<?= _SITE_URL?>/home.php">Home</a></li>
                <li class="logo"><a href="<?= _SITE_URL?>/index.php"><img src="<?= _SITE_URL ?>/images/logo.png" alt="Unwritten Cleaning" title="Unwritten Cleaning" /></a></li>
                <li class="<?= $about_cls?> aboutTab">
                <a href="<?= _SITE_URL?>/about.php">About Us</a>
                </li>
                /
                <li class="<?= $cleaning_cls?>">
                <a href="<?= _SITE_URL?>/pages/pages.php?pagename=cleaning_professional">Cleaning Professional</a>
                </li>
                <?php if (empty($_SESSION['txtId'])) { ?>
                <li class="loginTab"><a href="<?= _SITE_URL?>/user/">Login</a></li>
                <?php } else { ?>
                 <li class="dsbord">
                	<a href="<?= _SITE_URL?>/user/my_profile.php">Dashboard</a><button class="caret"></button>
                    <div class="dropdown">
                        <ul id="drpMenu" class="dropdown-menu dshBrdDrp">
                            <li><a href="<?= _SITE_URL?>/logout.php">Log-out</a></li>
                        </ul>   
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
