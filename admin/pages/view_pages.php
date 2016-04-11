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
include_once 'cls_pages.php';
$_SESSION['page_title'] = "View Pages | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
$collection_page = $objPage->getPageDetails("all","");

$del_id = base64_decode($db->getParam('flag'));
if (!empty($del_id)) {
  $objPage->deletePage($del_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <h4><strong>VIEW PAGES</strong></h4>
      <div class="col-md-12">&nbsp;</div>
      <div class="container"></div>
      <div class="table-responsive">
        <form name="frmViewPages" id="frmViewPages" method="post">
            <table class="table table-bordered table-hover">
              <thead class="thead-default">
                <tr>
                  <th>#</th>
                  <th>PAGE TITLE</th>
                  <th>PAGE URL</th>
                  <th>PAGE STATUS</th>
                  <th><center>ACTION</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($collection_page as $pages) {
                ?>
                <tr>
                  <th scope="row"><?php echo $i?></th>
                  <td><?php echo $pages['txtPageTitle']?></td>
                  <td><?php echo $pages['txtPageUrl']?></td>
                  <td><?php echo $active = ($pages['txtStatus'] == 1) ? "Publish" : "Disabled";?></td>
                  <td>
                    <center>
                        <a title="Edit" href="edit_pages.php?pid=<?= base64_encode($pages['txtId'])?>">
                            <button type="button" title="Edit">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                        </a>
                        &nbsp;&nbsp;
                        <a title="Delete">
                            <button type="button" title="Delete/Disabled" id="deletePage" value="<?php echo $pages['txtId']?>">
                                <i class="fa fa-trash"></i>
                            </button>
                        </a>
                    </center>
                  </td>
                </tr>
                <?php
                    $i++;
                }
                if (empty($collection_page)) {
                ?>
                <tr><td colspan="10">Sorry..! No records found.</td></tr>
                <?php } ?>
              </tbody>
            </table>
        </form>
      </div>
  </div>

  <?php include dirname(__DIR__).'/include/footer.php' ?>