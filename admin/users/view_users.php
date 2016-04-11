<?php
session_start();
ob_start();

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:/cleaning/admin/index.php");
}

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
$collection_users = $objUser->getUserDetails("all","");

$del_id = base64_decode($db->getParam('flag'));
if (!empty($del_id)) {
  $objUser->deleteUser($del_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <!-- Ppo-up To Add New Trainer Start -->
  <div style="display:none;" id="back-color"></div>
  <div style="display:none;" class="pop-up-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="myModalLabel" class="modal-title">Add User</h4>
          </div>
          <form method="post" action="#" name="frmAddUser" id="frmAddUser" class="frmMenus">
            <input type="hidden" id="form_edit_value" name="form_edit_value" value="">
            <input type="hidden" id="edit_users" name="edit_users" value="">
            <div class="modal-body">
                <div class="col-md-6 form-group">
                    <label>First Name&nbsp;<span>*</span></label>
                    <input class="form-control input-sm" type="text" id="txtFirstName" name="txtFirstName" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Last Name&nbsp;<span>*</span></span></label>
                    <input class="form-control input-sm" type="text" id="txtLastName" name="txtLastName" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Emai-id&nbsp;<span>*</span></span></label>
                    <input class="form-control input-sm" type="text" id="txtEmail" name="txtEmail" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Phone&nbsp;<span>*</span></span></label>
                    <input class="form-control input-sm" type="text" id="txtPhone" name="txtPhone" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address Line 1</label>
                    <input class="form-control input-sm" type="text" id="txtAddressLine1" name="txtAddressLine1" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address Line 2</label>
                    <input class="form-control input-sm" type="text" id="txtAddressLine2" name="txtAddressLine2" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Country</label>
                    <select class="form-control input-sm" id="txtCountry" name="txtCountry">
                      <option value="USA">USA</option>      
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Status</label>
                    <select class="form-control input-sm" id="txtState" name="txtState">
                      <option value="">-- Select --</option>
                      <option value="NY">New York</option>
                      <option value="CL">California</option>
                      <option value="AL">Alaska</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>City</label>
                    <input class="form-control input-sm" type="text" id="txtCity" name="txtCity" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Zipcode</label>
                    <input class="form-control input-sm" type="text" id="txtZipcode" name="txtZipcode" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Access Level</label>
                    <select class="form-control input-sm" id="txtUserLevel" name="txtUserLevel">
                      <option value="">-- Select --</option>
                      <option value="user">User</option>
                      <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Status&nbsp;<span>*</span></span></label>
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
  <!-- Ppo-up To Add New Trainer End -->

  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <div class="pull-left"><h4><strong>VIEW ACTIVE USERS</strong></h4></div>
      <div class="pull-right">
        <button type="button" id="btnAddPopUp" class="btn btn-primary">Add User</button>
      </div>
      <div class="clear"></div>
      <div class="col-md-12">&nbsp;</div>
      <form name="frmViewUsers" id="frmViewUsers" method="post">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>NAME</th>
              <th>EMAIL ID</th>
              <th>PHONE</th>
              <th>COUNTRY</th>
              <th>USER LEVEL</th>
              <th><center>ACTION</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($collection_users as $users) {
            ?>
            <tr>
              <th scope="row"><?php echo $i?></th>
              <td><?= $users['txtFirstName']." ".$users['txtLastName']?></td>
              <td><?= $users['txtEmail']?></td>
              <td><?= $users['txtPhone']?></td>
              <td><?= $users['txtCountry']?></td>
              <td><?= $users['txtUserLevel']?></td>
              <td>
                <center>
                    <a title="Edit">
                        <button type="button" title="Edit/Update" id="editUser" value="<?php echo $users['txtId']?>">
                            <i class="fa fa-pencil-square-o"></i>
                        </button>
                    </a>
                    &nbsp;&nbsp;
                    <?php if ($users['txtId'] == 1) {?>
                    <a title="Delete">
                        <button type="button" title="Not allow" disabled="">
                            <i class="fa fa-trash"></i>
                        </button>
                    </a>
                    <?php } else { ?>
                    <a title="Delete">
                        <button type="button" title="Delete/Deactive" id="deleteUser" value="<?php echo $users['txtId']?>">
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
              if (empty($collection_users)) {
              ?>
              <tr><td colspan="10">Sorry..! No records found.</td></tr>
              <?php } ?>
          </tbody>
        </table>
      </form>
  </div>

  <?php include dirname(__DIR__).'/include/footer.php' ?>