<?php
/* header.php
*  This file for header section in user dashboard
*/
?>

<body id="user-dashboard">
    <header>
    	<div class="container contentUpperMain">
            <div class="row">
                <div class="col-sm-6 logo">
                   <a href="<?= _SITE_URL?>/home.php"><img src="<?= _SITE_URL?>/images/logo.png" alt="Unwritten Cleaning" title="Unwritten Cleaning"  width="220px"/></a>
                </div>
                
                <div class="col-md-3">
                    <div class="notifImg pull-right">
                    	<span id="showUserNotyTot" class="notifCount"></span>
                    	<img id="user-notify" src="<?= _SITE_URL?>/images/notification.png" alt="Nitification" title="Nitification">
                        <ul id="user-notifications" class="dropdown-menu user-notty"></ul>
                    </div>
                </div>
                
                <div class="col-sm-3 userNotif">
                    <div class="dropdown notifName">
                        <button class="btn btn-default user-dropdown-toggle active" type="button" data-toggle="dropdown">
                            <b><?= "Welcome Back, ".$name?></b>
                            <span class="caret"></span>
                        </button>
                        <ul id="user-menu" class="dropdown-menu merge-side">
                            <li>
                                <a href="<?= _SITE_URL?>/user/account-settings.php">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Account Setting
                                </a>
                            </li>
                            <li>
                                <a href="<?= _SITE_URL?>/user/notification.php">
                                    <i class="fa fa-bell" aria-hidden="true"></i>&nbsp;Notifications
                                </a>
                            </li>
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