<?php
/* header.php
*  This file for header section in user dashboard
*/
?>

<body id="user-dashboard">
    <header>
    	<div class="container contentUpperMain">
            <div class="row">
                <div class="col-sm-3 logo">
                   <a href="#"><img src="<?= _SITE_URL?>/images/logo.png" alt="Unwritten Cleaning" title="Unwritten Cleaning" /></a>
                </div>
                
                <div class="col-md-6"></div>
                
                <div class="col-sm-3 userNotif">
                    <div class="notifImg">
                    	<span class="notifCount">1</span>
                    	<img src="<?= _SITE_URL?>/images/notification.png" alt="" title="" />
                    </div>
                    <div class="dropdown notifName">
                        <button class="btn btn-default dropdown-toggle active" type="button" data-toggle="dropdown">
                            <b><?= $name?></b>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu merge-side">
                            <span id="cross"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></span>
                            <li>
                                <a href="<?= _SITE_URL?>/home.php">
                                    <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Visit Site
                                </a>
                            </li>
                            <li>
                                <a href="<?= _SITE_URL?>/logout.php">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>