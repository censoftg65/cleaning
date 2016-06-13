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

$collection_trash = $objUser->getTrashUserDetails();

$user_id = base64_decode($db->getParam('flag'));
$user_stat = $db->getParam('status');

if (!empty($user_id) && ($user_stat == 'active')):
  $objUser->activateUser($user_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
endif;
if (!empty($user_id) && ($user_stat == 'delete')):
  $objUser->deleteTrashUser($user_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
endif;
?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>TRASH USERS</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
          <button type="button" id="btnActivateAll" id="btnActivateAll" class="btn btn-sm btn-warning">
            <span class="glyphicon glyphicon-share-alt"></span>&nbsp;Active
          </button>
          &nbsp;&nbsp;
          <button type="button" id="btnDeleteAllPermanant" id="btnDeleteAllPermanant" class="btn btn-sm  btn-danger">
            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
          </button>
        </div>
        <div class="col-md-12">&nbsp;</div>
      </div>
      
      <div class="col-md-12">
        <form name="frmViewTrashUsers" id="frmViewTrashUsers" method="post">
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
              foreach ($collection_trash as $users) {
              ?>
              <tr>
                <th scope="row"><?php echo $i?></th>
                <td><center><input class="checkbox1" type="checkbox" name="allSelect[]" id="allSelect" value="<?= $users['txtId']?>"></center></td>
                <td><a id="uname" title="User Name"><?= $users['txtFirstName']." ".$users['txtLastName']?></a></td>
                <td><?= $users['txtEmail']?></td>
                <td><?= $users['txtPhone']?></td>
                <td><?= $users['txtUserLevel']?></td>
                <td>
                  <center>
                      <a title="Enable/Activate User">
                        <button type="button" title="Enable/Activate User" name="btnActivateUser" id="btnActivateUser" value="<?= $users['txtId']?>">
                          <i class="fa fa-share" aria-hidden="true"></i>
                        </button>
                      </a> 
                      &nbsp;&nbsp;
                      <a title="Delete">
                          <button type="button" title="Delete Permanently" id="delete_permanant" value="<?= $users['txtId']?>">
                              <i class="fa fa-trash"></i>
                          </button>
                      </a>
                  </center>
                </td>
              </tr>
              <?php
                $i++;
              }
              if (empty($collection_trash)) {
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