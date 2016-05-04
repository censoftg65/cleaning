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

$_SESSION['page_title'] = "New Booking | "._SITE_NAME;
$db = new Config(); 
$extra_services = $objCommon->getExtraServices();

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <!-- Preview Booking Form Popup-->
    <div class="modal fade" id="book-preview" tabindex="-1" role="dialog" aria-labelledby="step1-preview" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="step1_previewLabel">Booking Preview</h3>
                </div>
                <div class="modal-body" style="padding-bottom:160px !important;">
                </div>
                <div class="clear"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel & Edit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End-->

    <section>
        <div class="container contentMain">
            <div class="row">
            
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>
                
                <div class="col-sm-9 contentPart">
                    <div class="col-sm-12">
                        <h2 class="compHead">Booking Form</h2>
                    </div>
                   

                    <form name="frmBookCleaning" id="frmBookCleaning" method="post" action="confirm_booking.php" onSubmit="return validateBookingForm();" >
                        <div class="row">
                        	<div class="col-sm-3">
                                <label>Choose Bedroom <span class="err">*</span></label>
                                <select id="txtBedroom" name="txtBedroom">
                                    <option value="0">&nbsp;Choose Number</option>
                                    <option value="1">&nbsp;1</option>
                                    <option value="2">&nbsp;2</option>
                                    <option value="3">&nbsp;3</option>
                                    <option value="4">&nbsp;4</option>
                                    <option value="5">&nbsp;5</option>
                                    <option value="6">&nbsp;6</option>
                                    <option value="7">&nbsp;7 & up</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Choose Bathroom</label>
                                <select id="txtBathroom" name="txtBathroom">
                                    <option value="0">&nbsp;Choose Number</option>
                                    <option value="1">&nbsp;1</option>
                                    <option value="2">&nbsp;2</option>
                                    <option value="3">&nbsp;3</option>
                                    <option value="4">&nbsp;4</option>
                                    <option value="5">&nbsp;5</option>
                                    <option value="6">&nbsp;6</option>
                                    <option value="6">&nbsp;7</option>
                                </select>
                            </div>
                        </div>
                    	<br><br>
                        <div class="row">
                        	<div class="col-sm-12 extraTxt">
                            	<label><strong>+/- Extra Services</strong></label>
                            </div>
                            <div class="col-sm-3 bookingLft">
                                <?php
                                $i = 1;
                                foreach ($extra_services as $ex_service):
                                    if($i == 8) break;
                                ?>
                                <input type="checkbox" class="serviceChkBox" data-serviceprice="<?= $ex_service['txtServicePrice']?>" data-servicehrs="<?= $ex_service['txtServiceHours']?>" name="txtExtraService[]" id="txtExtraService" value="<?= $ex_service['txtId']?>">
                                <label><?= $ex_service['txtServiceName']?></label>
                                <?php 
                                    $i++;
                                endforeach;
                                ?>
                            </div>
                            
                            <div class="col-sm-3 bookingRight">
                            	<label><u>Laundry</u></label>
                                <?php
                                $i = 1;
                                foreach ($extra_services as $ex_service):
                                    if($i > 7) :
                                ?>
                                <input type="checkbox" class="serviceChkBox" data-serviceprice="<?= $ex_service['txtServicePrice']?>" data-servicehrs="<?= $ex_service['txtServiceHours']?>" name="txtExtraService[]" id="txtExtraService" value="<?= $ex_service['txtId']?>">
                                <label><?= $ex_service['txtServiceName']?></label>
                                <?php 
                                    endif;
                                    $i++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Date of Service <span class="err">*</span></label> 
                                <div class="input-group">
                                    <input type="text" name="txtServiceDate" id="txtServiceDate" readonly>
                                    <div class="input-group-addon" id="cal"><i class="glyphicon glyphicon-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Time of Service <span class="err">*</span></label> 
                                <div class="input-group">
                                    <input type="text" class="time start" name="txtServiceTime" id="txtServiceTime">
                                    <div class="input-group-addon" id="time"><i class="glyphicon glyphicon-time"></i></div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Choose Number of hours</label>
                                <div class="input-group">
                                    <select id="txtServiceHours" name="txtServiceHours">
                                        <option value="0">Number of hours....</option>
                                    </select>
                                    <div class="input-group-addon" id="cal"><i class="glyphicon glyphicon-hourglass"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Extra Services (if any)</label>
                                <div class="input-group">
                                    <input type="text" id="txtExtraServiceHrs" name="txtExtraServiceHrs" readonly="" placeholder="Extra service hours">
                                    <div class="input-group-addon" id="cal"><i class="glyphicon glyphicon-hourglass"></i></div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Add Tip</label>
                                <div class="input-group">
                                    <input type="text" name="txtServiceTip" id="txtServiceTip" placeholder="$00000" />
                                    <div class="input-group-addon" id="cal">.00</div>
                                </div>
                            </div>
                        	<div class="col-sm-3">
                            	<label>Recurring Cleaning</label>
                                <select id="txtRecurring" name="txtRecurring">
                                	<option>One Time</option>
                                    <option>Every Week</option>
                                    <option>Every 2 Weeks</option>
                                    <option>Every 3 Weeks</option>
                                    <option>Once a Month</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Promo Code (if any)</label>
                                <input type="text" name="txtPromoCode" id="txtPromoCode" placeholder="Place promo code here" />&nbsp;
                            </div>
                            <div class="col-sm-5">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-danger" name="btnPromoCode" id="btnPromoCode">
                                    <span id="booking_loading" style="display: none"></span>Apply
                                </button>
                                <span id="offer-secc-msg"></span>
                                <span id="remove-offer"></span>
                                <input type="hidden" name="hidOfferPrice" id="hidOfferPrice" value="">
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Service Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon" id="cal">$</div>
                                    <select id="txtTotal" name="txtTotal" required="" disabled=""></select>
                                    <input type="hidden" name="hidtotal" id="hidtotal" value="">
                                    <div class="input-group-addon" id="cal">.00</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Extra Service Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon" id="cal">$</div>
                                    <input type="text" name="txtExtraServiceAmt" id="txtExtraServiceAmt" value="" readonly="">
                                    <div class="input-group-addon" id="cal">.00</div>
                                </div>    
                            </div>
                        </div>
                        <div class="bookingButtons">
                            <button type="button" class="btn btn-warning" id="btnPreview">Preview</button>
                        	<input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>