<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_bookings.php';
$db = new Config();

$rate_id = $db->getParam('rate_id');
$coll_rating = $objBooking->getBookRating($rate_id);
foreach ($coll_rating as $rate) {
	echo '<div class="form-group">';
		echo '<div class="col-sm-12">';
			echo '<label class="control-label"><strong>Service Provider</strong></label>';
			echo '<div class="">'.$rate['txtServiceProvider'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-12">&nbsp;</div>';	
		echo '<div class="col-sm-12">';
			echo '<label class="control-label"><strong>Rating</strong></label>';
			echo '<input id="rating-input" value="'.$rate['txtRating'].'" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm" disabled="disabled">';
		echo '</div>';	
		echo '<div class="col-sm-12">&nbsp;</div>';	
		echo '<div class="col-sm-12">';
			echo '<label class="control-label"><strong>Remarks</strong></label>';
			echo '<div>'.$rate['txtRatingComment'].'</div>';
		echo '</div>';
		echo '<div class="col-sm-12">&nbsp;</div>';	
	echo '</div>';
}

?>

<script src="<?= _BOOTSTRAP_URL?>/js/star-rating.js" type="text/javascript"></script>