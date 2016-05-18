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
   header("location:"._SITE_URL."/user/register.php");
}

$_SESSION['page_title'] = "Update Booking | "._SITE_NAME;
$db = new Config(); 

$bedroom = array('0'=>'Choose Number','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7 & up');
$bathroom = array('0'=>'Choose Number','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
$recurring = array('One Time'=>'One Time','Every Week'=>'Every Week','Every 2 Weeks'=>'Every 2 Weeks','Every 3 Weeks'=>'Every 3 Weeks','Once a Month'=>'Once a Month');

$extra_services = $objCommon->getExtraServices();
$bookId = base64_decode($db->getParam('book_id'));
if (!empty($bookId)) {
    $service_data = $objCommon->getServiceData($bookId,$uid);
    $service = $service_data[0];
}

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <section>
        <div class="container contentMain">
            <div class="row">
            
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>
                
                <div class="col-sm-9 contentPart">
                    <div class="col-sm-12">
                        <h2 class="compHead">Booking Form</h2>
                    </div>
                    
                    <form name="frmUpdateCleaning" id="frmUpdateCleaning" method="post">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Choose Bedroom <span class="err">*</span></label>
                                <select id="txtBedroom" name="txtBedroom">
                                    <?php foreach ($bedroom as $key => $value) { ?>
                                        <?= $selected = ($key == $service['txtBedroom']) ? "selected" : "" ?>
                                    <option value="<?= $key?>" <?= $selected?>>&nbsp;<?= $value?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Choose Bathroom</label>
                                <select id="txtBathroom" name="txtBathroom">
                                    <?php
                                    $result = $objCommon->getBathOnBed($service['txtBedroom']);
                                    $arr_result =  explode(",", $result[0]['txtBathRoom']);
                                    foreach ($arr_result as $bath_val) { 
                                        $selected = ($bath_val == $service['txtBathroom']) ? "selected" : "" 
                                    ?>
                                    <option value="<?= $bath_val?>" <?= $selected?>>&nbsp;<?= $bath_val?></option>
                                    <?php } ?>
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
                                        $checked = (in_array($ex_service['txtId'], explode(",", $service['txtExtraService']))) ? "checked" : "";
                                ?>
                                <input type="checkbox" class="serviceChkBox" data-serviceprice="<?= $ex_service['txtServicePrice']?>" data-servicehrs="<?= $ex_service['txtServiceHours']?>" name="txtExtraService[]" id="txtExtraService" value="<?= $ex_service['txtId']?>" <?= $checked?>>
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
                                        $checked = (in_array($ex_service['txtId'], explode(",", $service['txtExtraService']))) ? "checked" : "";
                                ?>
                                <input type="checkbox" class="serviceChkBox" data-serviceprice="<?= $ex_service['txtServicePrice']?>" data-servicehrs="<?= $ex_service['txtServiceHours']?>" name="txtExtraService[]" id="txtExtraService" value="<?= $ex_service['txtId']?>" <?= $checked?>>
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
                                    <input type="text" name="txtServiceDate" id="txtServiceDate" value="<?= $service['txtServiceDate']?>" readonly>
                                    <div class="input-group-addon" id="cal"><i class="glyphicon glyphicon-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Time of Service <span class="err">*</span></label> 
                                <div class="input-group">
                                    <input type="text" class="time start" name="txtServiceTime" id="txtServiceTime" value="<?= $service['txtServiceTime']?>">
                                    <div class="input-group-addon" id="time"><i class="glyphicon glyphicon-time"></i></div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Choose Number of hours</label>
                                <select id="txtServiceHours" name="txtServiceHours">
                                    <?php
                                    $result = $objCommon->getBathOnBed($service['txtBedroom']);
                                    $arr_result =  explode(",", $result[0]['txtHours']);
                                    foreach ($arr_result as $hrs_val) {
                                        $selected = ($hrs_val == $service['txtServiceHours']) ? "selected" : "";
                                    ?>
                                    <option value="<?= $hrs_val?>" <?= $selected?>><?= $hrs_val?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Extra Services (if any)</label>
                                <input type="text" id="txtExtraServiceHrs" name="txtExtraServiceHrs" value="<?= $service['txtExtraServiceHrs']?>" readonly="">
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Add Tip</label>
                                <div class="input-group">
                                    <div class="input-group-addon" id="cal">$</div>
                                    <input type="text" name="txtServiceTip" id="txtServiceTip" value="<?= $service['txtServiceTip']?>" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Recurring Cleaning</label>
                                <select id="txtRecurring" name="txtRecurring">
                                    <?php foreach ($recurring as $key => $value) { ?>
                                        <?= $selected = ($key == $service['txtRecurring']) ? "selected" : ""; ?>
                                    <option value="<?= $key?>" <?= $selected?>>&nbsp;<?= $value?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Service Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon" id="cal">$</div>
                                    <select id="txtServiceAmt" name="txtServiceAmt" required="" disabled="">
                                        <?php
                                        $result = $objCommon->getBathOnBed($service['txtBedroom']);
                                        $arr_result =  explode(",", $result[0]['txtPrice']);
                                        foreach ($arr_result as $price_val) {
                                            $selected = ($price_val == $service['txtServiceAmt']) ? "selected" : "";
                                        ?>
                                        <option value="<?= $price_val?>" <?= $selected?>><?= $price_val?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Extra Service Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon" id="cal">$</div>
                                    <input type="text" name="txtExtraServiceAmt" id="txtExtraServiceAmt" value="<?= $service['txtExtraServiceAmt']?>" readonly="">
                                </div>    
                            </div>
                        </div>
                        <div class="bookingButtons">
                            <button type="button" class="btn btn-warning" id="btnUpdatePreview">Preview</button>
                            <button type="button" class="btn btn-primary" id="btnUpdate" value="<?= $bookId?>">
                                <span id="cinfirm_loading" style="display:none"></span> Update
                            </button>
                        </div>
                        <div>
                            <input type="hidden" name="hidBookId" id="hidBookId" value="<?= $bookId?>">
                            <input type="hidden" name="hidServiceAmt" id="hidtotal" value="<?= $service['txtServiceAmt']?>">
                            <input type="hidden" name="hidPromoOffer" id="hidPromoOffer" value="<?= $service['txtPromoOffer']?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>

    <div style="display:none" id="back-color"></div>
    <!-- Preview Booking Form Popup-->
    <div class="modal fade" id="update-preview" tabindex="-1" role="dialog" aria-labelledby="step1-preview" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="step1_previewLabel">Booking Preview</h3>
                </div>
                <div id="pre-update" class="modal-body" style="padding-bottom:160px !important;"></div>
                <div class="clear"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End-->

    <!-- Confirm Booking Success Meaasgae Start -->
    <div style="display:none" class="modal-dialog" id="success-preview">
        <div class="modal-content">
            <div class="modal-body msg-body"></div>
        </div>
    </div>
    <!-- End-->