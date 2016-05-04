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

$_SESSION['page_title'] = "View Bookings | "._PANEL_NAME." :: "._SITE_NAME;
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$db = new Config();
$collection_booking = $objBooking->getBookingDetails();

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>VIEW BOOKINGS</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
          <button type="button" id="btnDelAllBooking" id="btnDelAllBooking" class="btn btn-sm  btn-danger">
            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
          </button>
        </div>
        <div class="col-md-12 open-up-msg pull-left">
            <div class="form-group">
                <div id="user-success-dialog" title="Thank you" style="display: none">
                    Booking updated successfully
                </div>
            </div>
        </div>
      </div>
      
      <div class="col-md-12">
        <form name="frmViewUsers" id="frmViewUsers" method="post">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th><center><input type="checkbox" name="selAllUser" id="selAllUser" value=""></center></th>
                <th>CLEANING PROCESS</th>
                <th>CLIENT NAME</th>
                <th>SERVICE PROVIDER</th>
                <th>DATE</th>
                <th><center>ACTION</center></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($collection_booking as $booked) {
              ?>
              <tr>
                <th scope="row"><?php echo $i?></th>
                <td><center><input class="checkbox1" type="checkbox" name="allSelect[]" id="allSelect" value="<?= $booked['txtId']?>"></center></td>
                <td><a id="uname" title="User Name"><?= $booked['txtEmail']?></td></a></td>
                <td><?= $booked['txtEmail']?></td>
                <td><?= $booked['txtPhone']?></td>
                <td><?= $booked['txtEmail']?></td>
                <td>
                  <center>
                      <a title="Edit User">
                          <button type="button" title="Edit/Update User" id="editUser" value="<?php echo $booked['txtId']?>">
                              <i class="fa fa-pencil-square" aria-hidden="true"></i>
                          </button>
                      </a>
                      &nbsp;
                      <?php if ($booked['txtOfferShare'] == 1) { ?>
                      <button type="button" title="Offer Alredy Sent" disabled="">
                        <!-- <i class="fa fa-exclamation-circle" aria-hidden="true"></i> -->
                        <i class="fa fa-check-square" aria-hidden="true"></i>
                      </button>
                      <?php } else { ?>
                      <a title="Send/Share Offer">
                          <button type="button" title="Send/Share Offer" id="shareOffer" value="<?php echo $booked['txtId']?>">
                              <i class="fa fa-share-square" aria-hidden="true"></i>
                          </button>
                      </a>
                      <?php } ?>
                      &nbsp;
                      <?php if ($booked['txtId'] == 1) {?>
                      <a title="Delete User">
                          <button type="button" title="Not allow" disabled="">
                              <i class="fa fa-trash"></i>
                          </button>
                      </a>
                      <?php } else { ?>
                      <a title="Delete">
                          <button type="button" title="Delete/Deactive User" id="deleteUser" value="<?php echo $booked['txtId']?>">
                              <i class="fa fa-trash"></i>
                          </button>
                      </a>
                      <?php } ?>
                  </center>
                </td>
              </tr>
              <?php
                  $i++;
              }
              if (empty($collection_booking)) {
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