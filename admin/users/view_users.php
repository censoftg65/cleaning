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
include 'cls_users.php';
$_SESSION['page_title'] = "View users | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$objUser->clearUserNotty();
$collection_users = $objUser->getUserDetails();
$collection_city = $objUser->getCities();
$collection_zips = $objUser->getZipCodes();

$del_id = base64_decode($db->getParam('flag'));
$del_stat = $db->getParam('status');
if (!empty($del_id) && $del_stat == 'deactive') {
  $objUser->deactiveUser($del_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}
if (!empty($del_id) && $del_stat == 'delete') {
  $objUser->deleteUser($del_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}
  
?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>VIEW ACTIVE USERS</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
        <button type="button" id="btnDelActUsers" id="btnDelActUsers" class="btn btn-sm  btn-danger">
            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
          </button>
          <button type="button" id="btnAddPopUp" class="btn btn-sm btn-primary">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Add User
          </button>
        </div>
        <br>
        <div class="col-md-12 open-up-msg pull-left">
            <div class="form-group">
                <div id="success-dialog-offer" title="Thank you" style="display: none">
                    Offer sent/share successfully.
                </div>
                <div id="user-success-dialog" title="Thank you" style="display: none">
                    User profile added/updated successfully.
                </div>
            </div>
        </div>
      </div>
      
      <div class="col-md-12">
        <form name="frmViewUsers" id="frmViewUsers" method="post">
          <table class="table table-bordered table-striped table-hover" id="dTable">
            <thead>
              <tr>
                <th>#</th>
                <th><center><input type="checkbox" name="selAllUser" id="selAllUser" value=""></center></th>
                <th>Name</th>
                <th>Email ID</th>
                <th>Phone</th>
                <th>Access Level</th>
                <th><center>Action</center></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($collection_users as $users) {
                // if ($users['txtUserLevel'] != 'admin') {
              ?>
              <tr>
                <th scope="row"><?php echo $i?></th>
                <td>
                  <?php if ($users['txtUserLevel'] != 'admin') {?>
                  <center><input class="checkbox1" type="checkbox" name="allSelect[]" id="allSelect" value="<?= $users['txtId']?>"></center>
                  <?php } else { } ?>
                </td>
                <td><a id="uname"><?= $users['txtFirstName']." ".$users['txtLastName']?></a></td>
                <td><?= $users['txtEmail']?></td>
                <td><?= $users['txtPhone']?></td>
                <td>
                  <?php if ($users['txtUserLevel'] == 'admin') { ?>
                  <strong><?= strtoupper($users['txtUserLevel'])?></strong>
                  <?php } else { ?>
                  <strong><?= strtoupper($users['txtUserLevel'])?></strong>
                  <?php } ?>
                </td>
                <td>
                  <center>
                      <?php if ($users['txtUserLevel'] != 'admin') {?>
                      <a title="Edit User">
                          <button type="button" title="Edit/Update User" id="editUser" value="<?php echo $users['txtId']?>">
                              <i class="fa fa-pencil-square" aria-hidden="true"></i>
                          </button>
                      </a>
                      &nbsp;
                      <?php if ($users['txtOfferShare'] == 1) { ?>
                      <button type="button" title="Offer Already Sent" disabled="">
                        <i class="fa fa-check-square" aria-hidden="true"></i>
                      </button>
                      <?php } else { ?>
                      <a title="Send/Share Offer">
                          <button type="button" title="Send/Share Offer" id="shareOffer" data-email="<?php echo $users['txtEmail']?>" value="<?php echo $users['txtId']?>">
                              <i class="fa fa-share-square" aria-hidden="true"></i>
                          </button>
                      </a>
                      <?php } ?>
                      &nbsp;
                      <a title="Delete">
                          <button type="button" title="Deactive User" id="deactiveUser" value="<?php echo $users['txtId']?>">
                              <i class="fa fa-times" aria-hidden="true"></i>
                          </button>
                      </a>
                      &nbsp;
                      <a title="Delete">
                          <button type="button" title="Delete User" id="deleteUser" value="<?php echo $users['txtId']?>">
                              <i class="fa fa-trash"></i>
                          </button>
                      </a>
                      <?php } else { ?>

                      <?php } ?>
                  </center>
                </td>
              </tr>
              <?php
                  $i++;
                // }
              }
              if (empty($collection_users)) {
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

  <!-- Ppo-up To Add New User Start -->
  <div style="display:none;" id="back-color"></div>
  <div style="display:none;" class="pop-up-user-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="myModalLabel" class="modal-title">Add/Edit User</h4>
          </div>
          <form method="post" action="#" name="frmAddUser" id="frmAddUser" class="frmMenus">
            <input type="hidden" id="user_edit_value" name="user_edit_value" value="">
            <input type="hidden" id="edit_users" name="edit_users" value="">
            <div class="modal-body">
                <div class="col-md-4 form-group">
                    <label>First Name&nbsp;<span>*</span></label>
                    <input class="form-control input-sm" type="text" id="txtFirstName" name="txtFirstName" value="">
                </div>
                <div class="col-md-4 form-group">
                    <label>Last Name&nbsp;<span>*</span></label>
                    <input class="form-control input-sm" type="text" id="txtLastName" name="txtLastName" value="">
                </div>
                <div class="col-md-4 form-group">
                    <label>Phone&nbsp;<span>*</span>&nbsp;<span class="errmsg"></span></label>
                    <input class="form-control input-sm" type="text" id="txtPhone" name="txtPhone" value="" maxlength="15">
                </div>
                <div class="col-md-12 form-group">
                    <label>Email-id&nbsp;<span>*</span></label>
                    <input class="form-control input-sm" type="text" id="txtEmail" name="txtEmail" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address Line 1</label>
                    <input class="form-control input-sm" type="text" id="txtAddressLine1" name="txtAddressLine1" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address Line 2</label>
                    <input class="form-control input-sm" type="text" id="txtAddressLine2" name="txtAddressLine2" value="">
                </div>
                <div class="col-md-4 form-group">
                    <label>Country</label>
                    <input type="text" class="form-control input-sm" id="txtCountry" name="txtCountry" value="USA" readOnly />
                </div>
                <div class="col-md-4 form-group">
                    <label>State/Provience</label>
                    <input type="text" class="form-control input-sm" id="txtState" name="txtState" value="NY" readOnly />
                </div>
                <div class="col-md-4 form-group">
                    <label>City</label>
                    <select class="form-control input-sm" id="txtCity" name="txtCity" required="">
                        <?php getOptions($collection_city,'txtCity','txtCity','')?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Zipcode</label>
                    <select class="form-control input-sm" id="txtZipcode" name="txtZipcode">
                        <?php getOptions($collection_zips,'txtZip','txtZip','')?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Access Level&nbsp;<span>*</span></label>
                    <select class="form-control input-sm" id="txtUserLevel" name="txtUserLevel">
                      <option value=""> -- Select -- </option>
                      <option value="user" selected="selected">User</option>
                      <!-- <option value="admin">Admin</option> -->
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Status&nbsp;<span>*</span></label>
                    <select class="form-control input-sm" id="txtStatus" name="txtStatus">
                      <option value="">-- Select --</option>
                      <option value="1">Activate</option>
                      <option value="0">Deactivate</option>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" id="close-user-form">Close</button>
              <button class="btn btn-primary" type="button" id="btnAddUser" name="btnAddUser">
                <span style="display:none" id="add_user_loading"></span>&nbsp;&nbsp;Save  
              </button>
            </div>
          </form>
        </div>
      </div>
  </div>
  <!-- Ppo-up To Add New User End -->
  
  <!-- Ppo-up To Share Offer Start -->
  <div style="display:none;" class="pop-up-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="myModalLabel" class="modal-title">Create Discount Offer</h4>
          </div>
          <form method="post" action="#" name="frmShareOffer" id="frmShareOffer" class="frmMenus">
            <input type="hidden" id="get_user_id" name="get_user_id" value="">
            <div class="modal-body">
              <div class="col-md-6 form-group">
                <label>Offer Code&nbsp;<span>*</span>&nbsp;</label>
                <input class="form-control input-sm" type="text" id="txtPromoCode" name="txtPromoCode" value="" readonly="">
              </div>
              <div class="col-md-3 form-group">
                <label>&nbsp;</label>
                <button type="button" class="form-control btn btn-xs btn-warning" id="btnGeneratCode">Generate Code</button>
              </div>
              <div class="col-md-3 form-group"></div>
              <div class="col-md-6 form-group">
                <label>Offer Discount (%)&nbsp;<span>*</span></span>&nbsp;<span class="errmsg"></span></label>
                <input class="form-control input-sm restrict-zero" type="text" id="txtOffer" name="txtOffer" value="" maxlength="2">
              </div>
              <div class="col-md-12 form-group">
                <label>Email ID</label>
                <input class="form-control input-sm" type="text" id="email-id" disabled="">
              </div>
            </div>
            <div class="clear"></div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" id="close-offer-form">Close</button>
              <button class="btn btn-primary" type="button" id="btnShareOffer" name="btnShareOffer">
                <span style="display:none" id="shareOffer_loading"></span>&nbsp;&nbsp;Save  
              </button>
            </div>
          </form>
        </div>
      </div>
  </div>
  <!-- Ppo-up To Share Offer End -->

<script type="text/javascript">
$(document).ready(function() {
  $('#dTable').DataTable( {
      "pagingType": "numbers",
      "ordering": false,
      "info":     false,
      "bFilter": false,
      "bInfo": false
  });
});
</script>