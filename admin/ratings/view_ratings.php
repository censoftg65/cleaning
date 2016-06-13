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
include 'cls_ratings.php';
$db = new Config();
$_SESSION['page_title'] = "View Ratings | "._PANEL_NAME." :: "._SITE_NAME;
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$objRating->clearRateNotty();
$rating_coll = $objRating->getRatingDetails();

$delId = base64_decode($db->getParam('flag'));
$delState = $db->getParam('status');
if (!empty($delId) && $delState == 'delete') {
  $objRating->deleteRatings($delId);
  header("Location:".basename($_SERVER['PHP_SELF']));
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>VIEW RATINGS</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
          <button type="button" id="btnDelAllRating" id="btnDelAllRating" class="btn btn-sm  btn-danger">
            <span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
          </button>
        </div>
        <div class="col-md-12 open-up-msg pull-left">&nbsp;</div>
      </div>
      
      <div class="col-md-12">
        <form name="frmViewRating" id="frmViewRating" method="post">
          <table class="table table-bordered table-striped table-hover" id="dTable">
            <thead>
              <tr>
                <th>#</th>
                <th><center><input type="checkbox" name="selAllRating" id="selAllRating" value=""></center></th>
                <th>Service Provider</th>
                <th>Rating</th>
                <th>Remark</th>
                <th><center>#</center></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($rating_coll as $rating) {
              ?>
              <tr>
                <th scope="row"><?php echo $i?></th>
                <td><center><input class="chkAllReat" type="checkbox" name="selAllRate[]" id="selAllRate" value="<?= $rating['txtId']?>"></center></td>
                <td><?= strtoupper($rating['txtServiceProvider'])?></td>
                <td>
                <?php
                if ($rating['txtRating'] == 0.5) {
                  echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 1) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 1.5) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 2) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 2.5) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 3) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 3.5) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 4) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 4.5) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                } elseif ($rating['txtRating'] == 5) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                }
                ?>
                </td>
                <td>
                <?php
                echo strlen($rating['txtRatingComment']) >= 50 ? 
                substr($rating['txtRatingComment'], 0, 49).'&nbsp;<a id="read-more" data-id="'.$rating["txtId"].'">Read more</a>' :  
                $rating['txtRatingComment'];  
                ?>
                </td>
                <td>
                  <center>
                      <a title="Delete">
                          <button type="button" title="Delete Process" id="deleteRating" value="<?= $rating['txtId']?>">
                              <i class="fa fa-trash"></i>
                          </button>
                      </a>
                  </center>
                </td>
              </tr>
              <?php
                  $i++;
              }
              if (empty($rating_coll)) {
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

  <!-- View Rating Comment -->
    <div class="modal fade" id="comment-pop-up" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">View Comment</h3>
                </div>
                <div class="modal-body" id="pre-comment" style="padding-bottom:160px !important;"></div>
                <div class="clear"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End -->

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