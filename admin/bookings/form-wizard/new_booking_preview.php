<?php
session_start();
ob_start();

require_once dirname(dirname(dirname(__DIR__))).'/inc/config.inc.php';
include_once dirname(dirname(dirname(__DIR__))).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_bookings.php';
$db = new Config();

$arr_book['txtBedroom'] 		= $db->getParam('txtBedroom');
$arr_book['txtBathroom'] 		= $db->getParam('txtBathroom');
$arr_book['txtExtraService']	= $db->getParam('txtExtraService');
$arr_book['txtServiceDate'] 	= $db->getParam('txtServiceDate');
$arr_book['txtServiceTime'] 	= $db->getParam('txtServiceTime');
$arr_book['txtServiceHours']	= $db->getParam('txtServiceHours');
$arr_book['txtExtraServiceHrs'] = $db->getParam('txtExtraServiceHrs');
$arr_book['txtServiceTip'] 		= $db->getParam('txtServiceTip');
$arr_book['txtRecurring'] 		= $db->getParam('txtRecurring');
$arr_book['txtServiceAmt'] 			= $db->getParam('hidServiceAmt');
$arr_book['txtExtraServiceAmt'] = $db->getParam('txtExtraServiceAmt');

$tot_amt = $arr_book['txtServiceAmt'] + $arr_book['txtExtraServiceAmt'] + $arr_book['txtServiceTip'];
if (!empty($arr_book['hidOfferPrice'])) {
	$dis_tot = ($tot_amt  * $arr_book['hidOfferPrice']) / 100;
} else {
	$dis_tot = 0;	
}
$grand_tot = $tot_amt - $dis_tot;

echo '<div class="col-sm-12">';
	echo '<div class="form-group">';

		echo '<div class="col-sm-6">';
			echo '<label class="col-sm-6 control-label"><strong>Bedroom</strong></strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtBedroom'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';
			echo '<label class="col-sm-6 control-label"><strong>Bathroom</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtBathroom'].'</div>';
		echo '</div>';		
		echo '<div class="col-sm-12">';
			echo '<label class="col-sm-3 control-label"><strong>Extra Services</strong></label>';
			echo '<div class="col-sm-9 ser-left-pad">';
				if (empty($arr_book['txtExtraService'])) {
					echo "Not Selected";	
				} else {
					$result_names = '';
					foreach ($arr_book['txtExtraService'] as $service_val) {
						$result_names .= displayName(_DB_PREFIX.'extra_services','txtServiceName',$service_val,'txtId').', ';
					}
					echo rtrim($result_names,', ');
				}
			echo '</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Date</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtServiceDate'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Time</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtServiceTime'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Hrs</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtServiceHours'].' hours</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Amt</strong></label>';
			echo '<div class="col-sm-6">$ '.$arr_book['txtServiceAmt'].'</div>';
		echo '</div>';
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Extra Service Hrs</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtExtraServiceHrs'].' hours</div>';
		echo '</div>';	
		if (empty($arr_book['txtExtraServiceAmt'])) {
			echo '<div class="col-sm-6">';	
				echo '<label class="col-sm-6 control-label"><strong>Extra Service Amt</strong></label>';
				echo '<div class="col-sm-6">Not Selected</div>';
			echo '</div>';	
		} else {
			echo '<div class="col-sm-6">';	
				echo '<label class="col-sm-6 control-label"><strong>Extra Service Amt</strong></label>';
				echo '<div class="col-sm-6">$ '.$arr_book['txtExtraServiceAmt'].'</div>';
			echo '</div>';	
		}
		if (!empty($arr_book['txtServiceTip'])) {
			echo '<div class="col-sm-6">';	
				echo '<label class="col-sm-6 control-label"><strong>Service Tip</strong></label>';
				echo '<div class="col-sm-6">$ '.$arr_book['txtServiceTip'].'</div>';
			echo '</div>';	
		} else { }
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Recurring</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtRecurring'].'</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Total Amt</strong></label>';
			echo '<div class="col-sm-6">$ '.$tot_amt.'</div>';
		echo '</div>';	
	echo '</div>';
echo '</div>';	

?>