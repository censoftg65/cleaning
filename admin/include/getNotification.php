<?php
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
include_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_classes.php';
$db = new Config();

$book_notify = $objSite->getBookingNotify();
$update_booking_notify = $objSite->getUpdateNotify();
$discount_notify = $objSite->getDiscountNotify();
$rating_notify = $objSite->getRateNotify();
$update_rating_notify = $objSite->getUpdateRateNotify();
$user_notify = $objSite->getUserNotify();

if ($db->getParam('complete_nitify') == 'complete_nitify') {
	$notty_tot = $book_notify + $update_booking_notify + $discount_notify + $rating_notify + $update_rating_notify + $user_notify;
	echo '<li><input type="hidden" name="hidNottyTot" id="hidNottyTot" value="'.$notty_tot.'"></li>';

	if ($book_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/bookings/pending_services.php"><span class="badge">'.$book_notify.'</span> New Booking</a></li>';
	endif;

	if ($update_booking_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/bookings/pending_services.php"><span class="badge">'.$update_booking_notify.'</span> Update Booking</a></li>';
	endif;

	if ($discount_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/offers/view_offers.php"><span class="badge">'.$discount_notify.'</span> Offer Taken</a></li>';
	endif;

	if ($rating_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/ratings/view_ratings.php"><span class="badge">'.$rating_notify.'</span> New Rating</a></li>';
	endif;

	if ($update_rating_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/ratings/view_ratings.php"><span class="badge">'.$update_rating_notify.'</span> Update Rating</a></li>';
	endif;

	if ($user_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/users/view_users.php"><span class="badge">'.$user_notify.'</span> New User</a></li>';
	endif;

	if ($book_notify == 0 && $update_booking_notify == 0 && $discount_notify == 0 && $rating_notify == 0 && $update_rating_notify == 0 && $user_notify == 0) {
		echo '<li><a><span class="badge">0</span> Notification not available</a></li>';
	}
}

if ($db->getParam('count') == 'count') {
	$notty_tot = $book_notify + $update_booking_notify + $discount_notify + $rating_notify + $update_rating_notify + $user_notify;
	echo '<li><input type="hidden" name="hidNottyTot" id="hidNottyTot" value="'.$notty_tot.'"></li>';

	if ($book_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/bookings/pending_services.php"><span class="badge">'.$book_notify.'</span> New Booking</a></li>';
	endif;

	if ($update_booking_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/bookings/pending_services.php"><span class="badge">'.$update_booking_notify.'</span> Update Booking</a></li>';
	endif;

	if ($discount_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/offers/view_offers.php"><span class="badge">'.$discount_notify.'</span> Offer Taken</a></li>';
	endif;

	if ($rating_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/ratings/view_ratings.php"><span class="badge">'.$rating_notify.'</span> New Rating</a></li>';
	endif;

	if ($update_rating_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/ratings/view_ratings.php"><span class="badge">'.$update_rating_notify.'</span> Update Rating</a></li>';
	endif;

	if ($user_notify != 0):
		echo '<li><a href="'._SITE_URL.'/admin/users/view_users.php"><span class="badge">'.$user_notify.'</span> New User</a></li>';
	endif;

	if ($book_notify == 0 && $update_booking_notify == 0 && $discount_notify == 0 && $rating_notify == 0 && $update_rating_notify == 0 && $user_notify == 0) {
		echo '<li><a><span class="badge">0</span> Notification not available</a></li>';
	}
}

$db->freeResult();
$db->close();

?>