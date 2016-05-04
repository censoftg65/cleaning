<?php
// Initialize the session.
session_start();
ob_start();

require_once dirname(dirname(__DIR__)).'/inc/config.inc.php';
require_once dirname(dirname(__DIR__)).'/inc/function.inc.php';
include_once dirname(__DIR__).'/cls_common.php';
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
$arr_book['txtPromoCode'] 		= $db->getParam('txtPromoCode');
$arr_book['hidOfferPrice'] 		= $db->getParam('hidOfferPrice');
$arr_book['hidtotal'] 			= $db->getParam('hidtotal');
$arr_book['txtExtraServiceAmt'] = $db->getParam('txtExtraServiceAmt');

$tot_amt = $arr_book['hidtotal'] + $arr_book['txtExtraServiceAmt'] + $arr_book['txtServiceTip'];
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
					foreach ($arr_book['txtExtraService'] as $service_val) {
						echo displayName(_DB_PREFIX.'extra_services','txtServiceName',$service_val,'txtId').', ';
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
			echo '<label class="col-sm-6 control-label"><strong>Service Hours</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtServiceHours'].' hours</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Amt</strong></label>';
			echo '<div class="col-sm-6">$ '.$arr_book['hidtotal'].'.00</div>';
		echo '</div>';
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Extra Service Hours</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtExtraServiceHrs'].' hours</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Extra Service Amt</strong></label>';
			echo '<div class="col-sm-6">$ '.$arr_book['txtExtraServiceAmt'].'.00</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Service Tip</strong></label>';
			echo '<div class="col-sm-6">$ '.$arr_book['txtServiceTip'].'.00</div>';
		echo '</div>';	
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Recurring</strong></label>';
			echo '<div class="col-sm-6">'.$arr_book['txtRecurring'].'</div>';
		echo '</div>';	
		if (empty($arr_book['txtPromoCode'])) {
		} else {
			echo '<div class="col-sm-6">';	
				echo '<label class="col-sm-6 control-label"><strong>Promo Code</strong></label>';
				echo '<div class="col-sm-6">'.$arr_book['hidOfferPrice'].'%</div>';
			echo '</div>';	
		}
		echo '<div class="col-sm-6">';	
			echo '<label class="col-sm-6 control-label"><strong>Total Amount</strong></label>';
			echo '<div class="col-sm-6">$ '.$tot_amt.'.00</div>';
		echo '</div>';	
		if (empty($arr_book['txtPromoCode'])) {
		} else {
			echo '<div class="col-sm-12">';	
				echo '<label class="col-sm-3 control-label"><strong>Grand Total</strong></label>';
				echo '<div class="col-sm-9 ser-left-pad">$ '.$grand_tot.'.00</div>';
			echo '</div>';	
		}	

	echo '</div>';
echo '</div>';	


$db->freeResult();
$db->close();

?>