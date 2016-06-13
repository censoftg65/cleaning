<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_bookings.php';
$db = new Config();

$process_id = $db->getParam('process_id');
$coll_booked = $objBooking->getBookingPreview($process_id);

foreach ($coll_booked as $book) {
	$ex_ser = explode(",", $book['txtExtraService']);
	echo '<div class="form-group">';
		echo '<div class="col-sm-6">';
			echo '<label class="col-sm-6 control-label"><strong>Bedroom</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtBedroom'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';
			echo '<label class="col-sm-6 control-label"><strong>Bathroom</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtBathroom'].'</div>';
		echo '</div>';
		if (empty($book['txtExtraService'])) {
			echo '<div class="col-sm-12">';
				echo '<label class="col-sm-3 control-label"><strong>Extra Services</strong></label>';
				echo '<div class="col-sm-9 ser-left-pad">Not Selected </div>';
			echo '</div>';	
		} else {
			echo '<div class="col-sm-12">';
				echo '<label class="col-sm-3 control-label"><strong>Extra Services</strong></label>';
				echo '<div class="col-sm-9 ser-left-pad">';
					$result_names = '';
					foreach ($ex_ser as $service_val) {
						$result_names .= displayName(_DB_PREFIX.'extra_services','txtServiceName',$service_val,'txtId').', ';
					}
					echo rtrim($result_names,', ');
				echo '</div>';
			echo '</div>';	
		}	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Date</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtServiceDate'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Time</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtServiceTime'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Hours</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtServiceHours'].' hours</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Amt</strong></label>';
			echo '<div class="col-sm-6">$ '.$book['txtServiceAmt'].'</div>';
		echo '</div>';
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Extra Service Hours</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtExtraServiceHrs'].' hours</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Extra Service Amt</strong></label>';
			echo '<div class="col-sm-6">$ '.$book['txtExtraServiceAmt'].'</div>';
		echo '</div>';	
		if (empty($book['txtServiceTip'])) {
		} else {	
			echo '<div class="col-sm-6">';	
				echo '<label class="col-sm-6 control-label"><strong>Service Tip</strong></label>';
				echo '<div class="col-sm-6">$ '.$book['txtServiceTip'].'</div>';
			echo '</div>';	
		}
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Recurring</strong></label>';
			echo '<div class="col-sm-6">'.$book['txtRecurring'].'</div>';
		echo '</div>';	
		if (empty($book['txtPromoCode'])) {
		} else {
			echo '<div class="col-sm-6">';	
				echo '<label class="col-sm-6 control-label"><strong>Promo Code</strong></label>';
				echo '<div class="col-sm-6">'.$book['txtPromoOffer'].'%</div>';
			echo '</div>';	
		}
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Total Amount</strong></label>';
			echo '<div class="col-sm-6">$ '.$book['txtTotalAmt'].'</div>';
		echo '</div>';	
		if (empty($book['txtPromoCode'])) {
		} else {
			echo '<div class="col-sm-12">';	
				echo '<label class="col-sm-3 control-label"><strong>Grand Total</strong></label>';
				echo '<div class="col-sm-9 ser-left-pad">$ '.$book['txtGrandTotal'].'</div>';
			echo '</div>';	
		}	
	echo '</div>';
}

?>