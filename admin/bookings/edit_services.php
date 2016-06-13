<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
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

require_once (dirname(dirname(__DIR__)).'/inc/config.inc.php');
include_once (dirname(dirname(__DIR__)).'/inc/function.inc.php');
include 'cls_bookings.php';
$db = new Config();
$_SESSION['page_title'] = "Update Bookings Service | "._PANEL_NAME." :: "._SITE_NAME;
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
    header("location:"._SITE_URL."/admin/");
}

$book_id = base64_decode($db->getParam('bookid'));
$bedroom = array('0'=>'Choose Number','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7 & up');
$bathroom = array('0'=>'Choose Number','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
$recurring = array('One Time'=>'One Time','Every Week'=>'Every Week','Every 2 Weeks'=>'Every 2 Weeks','Every 3 Weeks'=>'Every 3 Weeks','Once a Month'=>'Once a Month');

$extra_services = $objBooking->getExtraServices();

if (!empty($book_id)) {
    $service_call = $objBooking->getServieUpdate($book_id);
    $service = $service_call[0];
}

$delId = base64_decode($db->getParam('flag'));
$delStat = $db->getParam('status');
if (!empty($delId) && $delStat == 'complete') {
  $objBooking->completeServices($delId);
  header("Location:pending_services.php");
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9 contentPart">
      <div class="col-md-3">
        <h4><strong>UPDATE SERVICES</strong></h4>
      </div>
      <div class="col-md-5">
          <div id="booking-service" style="display:none"></div>
      </div>
      
      <div class="col-md-12">&nbsp;</div>

      <div class="col-md-12">
        <form name="frmUpdateBooking" id="frmUpdateBooking" method="post">
            <div class="row">
              <div class="col-md-3 form-group">
                  <label>Choose Bedroom&nbsp;<span>*</span></label>
                  <select class="form-control input-sm" id="txtBedroom" name="txtBedroom">
                      <?php foreach ($bedroom as $key => $value) { ?>
                          <?= $selected = ($key == $service['txtBedroom']) ? "selected" : "" ?>
                      <option value="<?= $key?>" <?= $selected?>>&nbsp;<?= $value?></option>
                      <?php } ?>
                  </select>
              </div>
              <div class="col-md-3 form-group">
                  <label>Choose Bathroom</label>
                  <select class="form-control input-sm" id="txtBathroom" name="txtBathroom">
                      <?php
                      $result = $objBooking->getBathOnBed($service['txtBedroom']);
                      $arr_result =  explode(",", $result[0]['txtBathRoom']);
                      foreach ($arr_result as $bath_val) { 
                          $selected = ($bath_val == $service['txtBathroom']) ? "selected" : "" 
                      ?>
                      <option value="<?= $bath_val?>" <?= $selected?>>&nbsp;<?= $bath_val?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12 extraTxt">
                  <label><strong>+/- Extra Services</strong></label>
              </div>
              <br /><br />
              <div class="col-md-3 bookingLft">
                  <?php
                  $i = 1;
                  foreach ($extra_services as $ex_service):
                      if($i == 8) break;
                          $checked = (in_array($ex_service['txtId'], explode(",", $service['txtExtraService']))) ? "checked" : "";
                  ?>
                  <label>
                      <input type="checkbox" class="form-control input-sm serviceChkBox" data-serviceprice="<?= $ex_service['txtServicePrice']?>" data-servicehrs="<?= $ex_service['txtServiceHours']?>" name="txtExtraService[]" id="txtExtraService" value="<?= $ex_service['txtId']?>" <?= $checked?>>
                      <?= $ex_service['txtServiceName']?>
                  </label>
                  <?php 
                      $i++;
                  endforeach;
                  ?>
              </div>
              <div class="col-md-3 bookingLft">
                  <label><u>Laundry</u></label>
                  <?php
                  $i = 1;
                  foreach ($extra_services as $ex_service):
                      if($i > 7) :
                          $checked = (in_array($ex_service['txtId'], explode(",", $service['txtExtraService']))) ? "checked" : "";
                  ?>
                  <label>
                      <input type="checkbox" class="form-control input-sm serviceChkBox" data-serviceprice="<?= $ex_service['txtServicePrice']?>" data-servicehrs="<?= $ex_service['txtServiceHours']?>" name="txtExtraService[]" id="txtExtraService" value="<?= $ex_service['txtId']?>" <?= $checked?>>
                      <?= $ex_service['txtServiceName']?>
                  </label>
                  <?php 
                      endif;
                      $i++;
                  endforeach;
                  ?>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-3 form-group">
                  <label>Date of Service&nbsp;<span>*</span></label> 
                  <div class="input-group">
                    <input type="text" class="form-control input-sm" name="txtServiceDate" id="txtServiceDate" value="<?= $service['txtServiceDate']?>">
                    <div class="input-group-addon" id="cal"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                  </div>
              </div>
              <div class="col-md-3 form-group">
                  <label>Time of Service&nbsp;<span>*</span></label> 
                  <div class="input-group">
                    <input type="text" class="form-control input-sm time start" name="txtServiceTime" id="txtServiceTime" value="<?= $service['txtServiceTime']?>">
                    <div class="input-group-addon" id="time"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                  </div>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-3 form-group">
                  <label>Choose Number of hours</label>
                  <select class="form-control input-sm" id="txtServiceHours" name="txtServiceHours">
                      <?php
                      $result = $objBooking->getBathOnBed($service['txtBedroom']);
                      $arr_result =  explode(",", $result[0]['txtHours']);
                      foreach ($arr_result as $hrs_val) {
                          $selected = ($hrs_val == $service['txtServiceHours']) ? "selected" : "";
                      ?>
                      <option value="<?= $hrs_val?>" <?= $selected?>><?= $hrs_val?></option>
                      <?php } ?>
                  </select>
              </div>
              <div class="col-md-3 form-group">
                  <label>Extra Services (if any)</label>
                  <input class="form-control input-sm" type="text" id="txtExtraServiceHrs" name="txtExtraServiceHrs" value="<?= $service['txtExtraServiceHrs']?>" readonly="" placeholder="Extra service hours">
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-3 form-group">
                  <label>Add Tip</label>
                  <div class="input-group">
                    <div class="input-group-addon" id="cal">$</div>
                    <input type="text" class="form-control input-sm" name="txtServiceTip" id="txtServiceTip" value="<?= $service['txtServiceTip']?>">
                  </div>
              </div>
              <div class="col-md-3 form-group">
                  <label>Recurring Cleaning</label>
                  <select class="form-control input-sm" id="txtRecurring" name="txtRecurring">
                      <?php foreach ($recurring as $key => $value) { ?>
                          <?= $selected = ($key == $service['txtRecurring']) ? "selected" : ""; ?>
                      <option value="<?= $key?>" <?= $selected?>>&nbsp;<?= $value?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-3 form-group">
                  <label>Service Amount</label>
                  <div class="input-group">
                    <div class="input-group-addon" id="cal">$</div>
                    <select class="form-control input-sm" id="txtServiceAmt" name="txtServiceAmt" required="" disabled="">
                        <?php
                        $result = $objBooking->getBathOnBed($service['txtBedroom']);
                        $arr_result =  explode(",", $result[0]['txtPrice']);
                        foreach ($arr_result as $price_val) {
                            $selected = ($price_val == $service['txtServiceAmt']) ? "selected" : "";
                        ?>
                        <option value="<?= $price_val?>" <?= $selected?>><?= $price_val?></option>
                        <?php } ?>
                    </select>
                  </div>
              </div>
              <div class="col-md-3 form-group">
                  <label>Extra Service Amount</label>
                  <div class="input-group">
                    <div class="input-group-addon" id="cal">$</div>
                    <input type="text" class="form-control input-sm" name="txtExtraServiceAmt" id="txtExtraServiceAmt" value="<?= $service['txtExtraServiceAmt']?>"" readonly="">
                  </div>
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-md-12 form-group">
                <button type="button" class="btn btn-warning" id="btnPreviewEdit">Preview</button>
                <button type="button" class="btn btn-primary" id="btnEditBook">
                  <span id="service_loading" style="display:none"></span> Update Booking
                </button>
                <button type="button" class="btn btn-info" id="completedService" value="<?= $service['txtId']?>">Complete Booking</button>
            </div> 
            <div>
                <input type="hidden" name="hidBookId" id="hidBookId" value="<?= $book_id?>">
                <input type="hidden" name="hidServiceAmt" id="hidtotal" value="<?= $service['txtServiceAmt']?>">
                <input type="hidden" name="hidPromoOffer" id="hidPromoOffer" value="<?= $service['txtPromoOffer']?>">
                <input type="hidden" name="hidEditTag" id="hidEditTag" value="Edit Service">
            </div> 
        </form>
      </div>
  </div>

  <?php include dirname(__DIR__).'/include/footer.php' ?>

  <!-- Preview Booking Form Popup-->
  <div class="modal fade" id="book-preview" tabindex="-1" role="dialog" aria-labelledby="step1-preview" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h3 class="modal-title" id="step1_previewLabel">Booking Preview</h3>
              </div>
              <div class="modal-body">
              </div>
              <div class="clear"></div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- End-->

