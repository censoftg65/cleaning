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
$collection_users = $objUser->getDeactiveUserDetails("all","");

$user_id = base64_decode($db->getParam('flag'));
$status = $db->getParam('status');
if (!empty($user_id) && empty($status)):
  $objUser->deleteUserPermanantly($user_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
elseif (!empty($user_id) && !empty($status)):
  $objUser->changeUserStatus($user_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
else: echo ""; 
endif;
?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
      <div class="pull-left"><h4><strong>VIEW DEACTIVE USERS</strong></h4></div>
      <div class="clear"></div>
      <div class="col-md-12">&nbsp;</div>
      <form name="frmViewDeactiveUsers" id="frmViewDeactiveUsers" method="post">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>NAME</th>
              <th>EMAIL ID</th>
              <th>PHONE</th>
              <th>COUNTRY</th>
              <th>USER LEVEL</th>
              <th><center>#</center></th>
              <th><center>#</center></th>
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
                    <?php if ($users['txtId'] == 1) {?>
                    <a title="Delete">
                        <button type="button" title="Not allow" disabled="">
                            <i class="fa fa-trash"></i>
                        </button>
                    </a>
                    <?php } else { ?>
                    <a title="Delete">
                        <button type="button" title="Delete Permanently" id="deleteUser_permant" value="<?= $users['txtId']?>">
                            <i class="fa fa-trash"></i>
                        </button>
                    </a>
                    <?php } ?>
                </center>
              </td>
              <td>
                <center>
                    <input type="checkbox" name="txtStatus[]" id="txtStatus" title="Activate User Profile" value="<?= $users['txtId']?>">
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