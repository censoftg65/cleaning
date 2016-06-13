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
include_once 'cls_pages.php';
$_SESSION['page_title'] = "View Pages | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$collection_page = $objPage->getTrashPagesDetails();

$del_id = base64_decode($db->getParam('flag'));
if (!empty($del_id)) {
  $objPage->deletePagePermanent($del_id);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>TRASH PAGES</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
          <button type="button" id="btnMoveAllPage" id="btnMoveAllPage" class="btn btn-sm btn-warning">
            <span class="glyphicon glyphicon-share-alt"></span>&nbsp;Active
          </button>
          &nbsp;&nbsp;
          <button type="button" id="btnDeleteAllPage" id="btnDeleteAllPage" class="btn btn-sm  btn-danger">
            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
          </button>
        </div>
        <div class="col-xs-12">&nbsp;</div>
      </div>
      <div class="col-md-12">
        <form name="frmViewPages" id="frmViewPages" method="post">
            <table class="table table-bordered table-striped table-hover" id="dTable">
              <thead class="thead-default">
                <tr>
                  <th>#</th>
                  <th><center><input type="checkbox" name="selAllPage" id="selAllPage" value=""></center></th>
                  <th>Page Title</th>
                  <th>Page URL</th>
                  <th>Created Date</th>
                  <th>Updated Date</th>
                  <th>Page Status</th>
                  <th><center>Action</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($collection_page as $pages) {
                ?>
                <tr>
                  <th scope="row"><?php echo $i?></th>
                  <td><center><input class="check-page" type="checkbox" name="allSelPage[]" id="allSelPage" value="<?= $pages['txtId']?>"></center></td>
                  <td><a href="<?= _SITE_URL?>/pages/pages.php?pagename=<?= $pages['txtPageEntity']?>" title="View Page" target="_blank"><?php echo strtoupper($pages['txtPageTitle'])?></a></td>
                  <td><?php echo "pages/".$pages['txtPageUrl']?></td>
                  <td><?php echo $pages['txtDateTime']?></td>
                  <td><?php echo $pages['txtUpdateTime']?></td>
                  <td><?php echo $active = ($pages['txtStatus'] == 1) ? "Published" : "Un-published";?></td>
                  <td>
                    <center>
                        <a title="Delete">
                            <button type="button" title="Delete" id="deletePage" value="<?php echo $pages['txtId']?>">
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