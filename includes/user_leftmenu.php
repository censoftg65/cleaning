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
if (($_SERVER['REQUEST_URI'] == "/cleaning/user/new_booking.php" ) || ($_SERVER['REQUEST_URI'] == "/cleaning/user/confirm_booking.php")) {
	$booking_cls = "selected";
} else {
	$booking_cls = "";
}
if (($_SERVER['REQUEST_URI'] == "/cleaning/user/complete_services.php") || ($_SERVER['REQUEST_URI'] == "/cleaning/user/pending_services.php")) {
	$service_cls = "selected";
} else {
	$service_cls = "";
}
$pending_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/pending_services.php" ) ? "selected" : "";
$complete_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/complete_services.php" ) ? "selected" : "";
$rating_cls = ($_SERVER['REQUEST_URI'] == "/cleaning/user/view_ratings.php" ) ? "selected" : "";
/*-- End --*/

?>	
    <div class="col-sm-3 leftSidebar">
		<ul>
        	<li class="<?= $profile_cls?>"><a href="<?= _SITE_URL?>/user/my_profile.php"><img src="<?= _IMAGE_URL?>/side-list-1.png" alt="" title="" /> <br /> My Profile</a></li>
            <li class="<?= $booking_cls?>"><a href="<?= _SITE_URL?>/user/new_booking.php"><img src="<?= _IMAGE_URL?>/side-list-3.png" alt="" title="" /> <br /> New Booking</a></li>
            <li class="<?= $service_cls?> bookServTab">
                <div class="dropdown bookServ">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <img src="<?= _IMAGE_URL?>/side-list-4.png" alt="" title="" /><br>Booking Services<span class="caret glyphicon glyphicon-plus"></span>
                    </button>
                    <ul id="book-tab" class="dropdown-menu">
                        <li class="<?= $pending_cls?>"><a href="<?= _SITE_URL?>/user/pending_services.php">Pending</a></li>
                        <li class="<?= $complete_cls?>"><a href="<?= _SITE_URL?>/user/complete_services.php">Completed</a></li>
                    </ul>
                </div>
            </li>   
            <li class="<?= $rating_cls?>"><a href="<?= _SITE_URL?>/user/view_ratings.php"><img src="<?= _IMAGE_URL?>/side-list-5.png" alt="" title="" /> <br /> Ratings</a></li>
        </ul>
	</div>