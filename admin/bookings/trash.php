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
$_SESSION['page_title'] = "Trash Bookings | "._PANEL_NAME." :: "._SITE_NAME;
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$coll_trash_booking = $objBooking->getTrashBookingDetails();

$delId = base64_decode($db->getParam('flag'));
$delStat = $db->getParam('status');
if (!empty($delId) && $delStat == 'delete') {
  $objBooking->deleteBooking($delId);
  $objBooking->deleteRating($delId);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>TRASH BOOKINGS</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
          <button type="button" id="btnEnableSer" id="btnEnableSer" class="btn btn-sm btn-warning">
            <span class="glyphicon glyphicon-share-alt"></span>&nbsp;Active
          </button>
          &nbsp;&nbsp;
          <button type="button" id="btnDelAllPermanantly" id="btnDelAllPermanantly" class="btn btn-sm  btn-danger">
            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
          </button>
        </div>
        <div class="col-md-12">&nbsp;</div>
      </div>
      
      <div class="col-md-12">
        <form name="frmViewTrashBooking" id="frmViewTrashBooking" method="post">
          <table class="table table-bordered table-striped table-hover" id="dTable">
            <thead>
              <tr>
                <th>#</th>
                <th><center><input type="checkbox" name="selAllProcess" id="selAllProcess" value=""></center></th>
                <th>Cleaning Process</th>
                <th>Client Name</th>
                <th>Booking Date/Time</th>
                <th>Price</th>
                <th><center>Action</center></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($coll_trash_booking as $booked) {
              ?>
              <tr>
                <th scope="row"><?php echo $i?></th>
                <td><center><input class="chkService" type="checkbox" name="selProcess[]" id="selProcess" value="<?= $booked['txtId']?>"></center></td>
                <td>
                  <a class="clean_process" title="Preview Cleaning Process" data-id="<?= $booked['txtId']?>">
                    <?= strtoupper($booked['txtBedroom']." Bedroom & ".$booked['txtBathroom']." Bathroom")?>
                  </a>
                </td>
                <td><?= $booked['txtFirstName']." ".$booked['txtLastName']?></td>
                <td><?= $booked['txtServiceDate']." - ".$booked['txtServiceTime']?></td>
                <td><?= "$ ".$booked['txtGrandTotal']?></td>
                <td>
                  <center>
                      <a title="Delete">
                          <button type="button" title="Delete Process" id="deleteService" value="<?= $booked['txtId']?>">
                              <i class="fa fa-trash"></i>
                          </button>
                      </a>
                  </center>
                </td>
              </tr>
              <?php
                  $i++;
              }
              if (empty($coll_trash_booking)) {
              ?>
              <tr class="no-record">
                <td colspan="10">Sorry..! No records found.</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
      </div>
  </div>

  <?php include dirname(__DIR__).'/include/footer.php' ?>

  <!-- Preview Booking Form Popup-->
  <div class="modal fade" id="preview-process" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="step1_previewLabel">Booking Preview</h4>
              </div>
              <div class="modal-body" style="padding-bottom:160px !important;">
              </div>
              <div class="clear"></div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
          </div>
      </div>
  </div>
  <!-- End-->

<script type="text/javascript">
$(document).ready(function() {
  //var _$ = jQuery.noConflict(true);
  $('#dTable').DataTable( {
      "pagingType": "numbers",
      "ordering": false,
      "info":     false,
      "bFilter": false,
      "bInfo": false
  });
});
</script>  
