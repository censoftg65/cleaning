<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$name = $_SESSION["txtFirstName"]." ".$_SESSION["txtLastName"];
//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value) {
    if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

require_once dirname(__DIR__).'/inc/config.inc.php';
require_once dirname(__DIR__).'/inc/function.inc.php';
include_once 'cls_common.php';

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/user/");
}

$_SESSION['page_title'] = "Confirm Booking | "._SITE_NAME;
$db = new Config(); 

$arr_book['txtOrderId']         = randomNumber(9);
$arr_book['txtBedroom']         = $db->getParam('txtBedroom');
$arr_book['txtBathroom']        = $db->getParam('txtBathroom');
$arr_book['extraService']       = $db->getParam('txtExtraService');
$arr_book['txtExtraService']    = implode(",", $db->getParam('txtExtraService'));
$arr_book['txtServiceDate']     = $db->getParam('txtServiceDate');
$arr_book['txtServiceTime']     = $db->getParam('txtServiceTime');
$arr_book['txtServiceHours']    = $db->getParam('txtServiceHours');
$arr_book['txtExtraServiceHrs'] = $db->getParam('txtExtraServiceHrs');
$arr_book['txtServiceTip']      = $db->getParam('txtServiceTip');
$arr_book['txtRecurring']       = $db->getParam('txtRecurring');
$arr_book['txtPromoCode']       = $db->getParam('txtPromoCode');
$arr_book['hidOfferPrice']      = $db->getParam('hidOfferPrice');
$arr_book['txtServiceAmt']      = $db->getParam('hidtotal');
$arr_book['txtExtraServiceAmt'] = $db->getParam('txtExtraServiceAmt');

$tot_amt = $arr_book['txtServiceAmt'] + $arr_book['txtExtraServiceAmt'] + $arr_book['txtServiceTip'];
if (!empty($arr_book['hidOfferPrice'])) {
    $dis_tot = ($tot_amt  * $arr_book['hidOfferPrice']) / 100;
} else {
    $dis_tot = 0;   
}
$grand_tot = $tot_amt - $dis_tot;

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>
    
    <section>
        <div class="container contentMain">
            <div class="row">
                
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>
                
                <div class="col-sm-9 contentPart">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <h2 class="compHead">Confirm To Pay</h2>
                        </div>
                    </div>
                   
                    <form name="frm-ConfirmBooking" id="frm-ConfirmBooking" method="post" action="payment.php">
                        <div class="row">
                        <?php
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
                                if (empty($arr_book['extraService'])) {
                                    echo '<div class="col-sm-12">';
                                        echo '<label class="col-sm-3 control-label"><strong>Extra Services</strong></label>';
                                        echo '<div class="col-sm-9 ser-left-pad">Not Selected</div>';
                                    echo '</div>';  
                                } else {
                                    echo '<div class="col-sm-12">';
                                        echo '<label class="col-sm-3 control-label"><strong>Extra Services</strong></label>';
                                        echo '<div class="col-sm-9 ser-left-pad">';
                                                $result_names = '';
                                                foreach ($arr_book['extraService'] as $service_val) {
                                                    $result_names .= displayName(_DB_PREFIX.'extra_services','txtServiceName',$service_val,'txtId').', ';
                                                }
                                                echo rtrim($result_names,', ');
                                        echo '</div>';
                                    echo '</div>';  
                                }
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
                                    echo '<div class="col-sm-6">$ '.$arr_book['txtServiceAmt'].'</div>';
                                echo '</div>';
                                echo '<div class="col-sm-6">';  
                                    echo '<label class="col-sm-6 control-label"><strong>Extra Service Hours</strong></label>';
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
                                if (empty($arr_book['txtPromoCode'])) {
                                } else {
                                    echo '<div class="col-sm-6">';  
                                        echo '<label class="col-sm-6 control-label"><strong>Promo Offer</strong></label>';
                                        echo '<div class="col-sm-6">'.$arr_book['hidOfferPrice'].'%</div>';
                                    echo '</div>';  
                                }
                                echo '<div class="col-sm-6">';  
                                    echo '<label class="col-sm-6 control-label"><strong>Total Amount</strong></label>';
                                    echo '<div class="col-sm-6">$ '.number_format($tot_amt).'</div>';
                                echo '</div>';  
                                if (empty($arr_book['txtPromoCode'])) {
                                } else {
                                    echo '<div class="col-sm-12">'; 
                                        echo '<label class="col-sm-3 control-label"><strong>Grand Total</strong></label>';
                                        echo '<div class="col-sm-9 ser-left-pad">$ '.number_format($grand_tot).'</div>';
                                    echo '</div>';  
                                }    

                            echo '</div>';
                        echo '</div>';  
                        ?>
                        </div>

                        <div class="bookingButtons">
                        	<button type="button" class="btn btn-default" id="btnCancelBooking">Cancel Booking</button>
                            
                            <!-- Payment Integration Form -->
                            <script src="https://checkout.stripe.com/checkout.js" 
                                class="stripe-button" 
                                data-key="pk_test_06cyiC9ossQzpksn09Lh7EbK" 
                                data-image="http://centurysoftwares.com/cleaning/images/logo.png" 
                                data-name="Unwritten Cleaning" 
                                data-description="Test Transaction ($<?= number_format($grand_tot)?>)"
                                data-amount="<?= number_format($grand_tot)?>00" />
                            </script>
                        </div>
                        <div style="display: none">
                            <input type="hidden" name="orderid" id="orderid" value="<?= $arr_book['txtOrderId']?>">
                            <input type="hidden" name="bedroom" id="bedroom" value="<?= $arr_book['txtBedroom']?>">
                            <input type="hidden" name="bathrrom" id="bathrrom" value="<?= $arr_book['txtBathroom']?>">
                            <input type="hidden" name="ex-service" id="ex-service" value="<?= $arr_book['txtExtraService']?>">
                            <input type="hidden" name="servicedate" id="servicedate" value="<?= $arr_book['txtServiceDate']?>">
                            <input type="hidden" name="servicetime" id="servicetime" value="<?= $arr_book['txtServiceTime']?>">
                            <input type="hidden" name="servicehrs" id="servicehrs" value="<?= $arr_book['txtServiceHours']?>">
                            <input type="hidden" name="ex-servicehrs" id="ex-servicehrs" value="<?= $arr_book['txtExtraServiceHrs']?>">
                            <input type="hidden" name="serviceamt" id="serviceamt" value="<?= $arr_book['txtServiceAmt']?>">
                            <input type="hidden" name="ex-serviceamt" id="ex-serviceamt" value="<?= $arr_book['txtExtraServiceAmt']?>">
                            <input type="hidden" name="servicetip" id="servicetip" value="<?= $arr_book['txtServiceTip']?>">
                            <input type="hidden" name="recurring" id="recurring" value="<?= $arr_book['txtRecurring']?>">
                            <input type="hidden" name="promo" id="promo" value="<?= $arr_book['txtPromoCode']?>">
                            <input type="hidden" name="offerprice" id="offerprice" value="<?= $arr_book['hidOfferPrice']?>">
                            <input type="hidden" name="totamt" id="totamt" value="<?= number_format($tot_amt)?>">
                            <input type="hidden" name="grandtot" id="grandtot" value="<?= number_format($grand_tot)?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>

    <!-- Confirm Booking Success Meaasgae Start -->
    <div style="display:none" id="back-color"></div>
    <div style="display:none" class="modal-dialog" id="success-preview">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
    <!-- Confirm Booking Success Meaasgae End -->
