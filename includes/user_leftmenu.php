<?php
/* header.php
*  This file for leftmenu section in user dashboard
*/

/*
* Auther : Vinek T.
* Description : PHP Script for setting the menu activation arrow to the respective pages
* Date : 3rd May'2016
*/    
$profile_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/my_profile.php" ) ? "selected" : "";
$account_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/account-settings.php" ) ? "selected" : "";
$booking_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/new_booking.php" ) ? "selected" : "";
$booking_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/confirm_booking.php" ) ? "selected" : "";
$service_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/completed-services.php" ) ? "selected" : "";
$rating_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/completed-services.php" ) ? "selected" : "";
/*-- End --*/

?>	
    <div class="col-sm-3 leftSidebar">
		<ul>
        	<li class="<?= $profile_cls?>"><a href="<?= _SITE_URL?>/user/my_profile.php"><img src="<?= _IMAGE_URL?>/side-list-1.png" alt="" title="" /> <br /> My Profile</a></li>
            <li class="<?= $account_cls?>"><a href="<?= _SITE_URL?>/user/account-settings.php"><img src="<?= _IMAGE_URL?>/side-list-2.png" alt="" title="" /> <br /> Account Settings</a></li>
            <li class="<?= $booking_cls?>"><a href="<?= _SITE_URL?>/user/new_booking.php"><img src="<?= _IMAGE_URL?>/side-list-3.png" alt="" title="" /> <br /> New Booking</a></li>
            <li class="<?= $service_cls?>"><a href="#"><img src="<?= _IMAGE_URL?>/side-list-4.png" alt="" title="" /> <br /> Booking Services</a></li>
            <li class="<?= $rating_cls?>"><a href="#"><img src="<?= _IMAGE_URL?>/side-list-5.png" alt="" title="" /> <br /> Ratings</a></li>
        </ul>
	</div>