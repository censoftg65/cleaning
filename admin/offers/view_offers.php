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
include_once 'cls_offers.php';
$_SESSION['page_title'] = "View Offers | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$objOffers->clearOfferNotty();
$collection_offer = $objOffers->getOfferDetails();
$collection_user = $objOffers->getOfferUser();

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

  <?php include dirname(__DIR__).'/include/left_menu.php' ?>

  <div class="col-md-9">
      <div class="col-md-12">
        <h4><strong>VIEW OFFERS</strong></h4>
        <div class="pull-left">
          <input class="form-control input-sm" size="30" type="text" name="txtSearch" id="txtSearch" placeholder="Search here...">
        </div>
        <div class="pull-right">
          <button type="button" id="btnCreateOffer" class="btn btn-sm btn-primary">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Create Offers
          </button>
        </div>
        <div class="col-md-12 open-up-msg">
            <div class="form-group">
                <div id="save-offer-dialog" title="Thank you" style="display: none">
                    Offer created/shared successfully.
                </div>
            </div>
        </div>
      </div>

      <div class="col-md-12">
        <form name="frmViewOffers" id="frmViewOffers" method="post">
            <table class="table table-bordered table-striped table-hover" id="dTable">
              <thead class="thead-default">
                <tr>
                  <th>#</th>
                  <th>Offer Code</th>
                  <th>Offer Amount</th>
                  <th>Offer Created</th>
                  <th>Offer Taken</th>
                  <th><center>Status</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($collection_offer as $offers) {
                ?>
                <tr>
                  <th scope="row"><?php echo $i?></th>
                  <td><a id="uname" title="Offer Code"><?= $offers['txtPromoCode']?></a></td>
                  <td><?= $offers['txtOffer']."%"?></td>
                  <td><?= $offers['txtCreated']?></td>
                  <td><?= $offers['firstname']." ".$offers['lastname']?></td>
                  <td>
                    <center>
                      <?= $offer = ($offers['txtStatus'] == 1) ? 
                        '<button type="button" class="btn btn-xs btn-success">Available</button>' : 
                        '<button type="button" class="btn btn-xs btn-danger">Used</button>'
                      ?>
                    </center>
                  </td>
                </tr>
                <?php
                    $i++;
                }
                if (empty($collection_offer)) {
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

  <!-- Ppo-up To Create Promotional Offers Start -->
  <div style="display:none;" id="back-color"></div>
  <div style="display:none;" class="pop-up-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="myModalLabel" class="modal-title">Create Discount Offer</h4>
          </div>
          <form method="post" action="#" name="frmCreateOffer" id="frmCreateOffer" class="frmMenus">
            <input type="hidden" id="form_edit_value" name="form_edit_value" value="">
            <input type="hidden" id="edit_offer" name="edit_offer" value="">
            <div class="modal-body">
              <div class="col-md-6 form-group">
                <label>Offer Code&nbsp;<span>*</span></label>
                <input class="form-control input-sm" type="text" id="txtPromoCode" name="txtPromoCode" value="" readonly="">
              </div>
              <div class="col-md-3 form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-md btn-warning" id="btnGeneratCode">Generate Code</button>
              </div>
              <div class="col-md-3 form-group">&nbsp;</div>
              <div class="col-md-6 form-group">
                <label>Offer Discount (%)&nbsp;<span>*</span></span>&nbsp;<span class="errmsg"></span></label>
                <input class="form-control input-sm restrict-zero" type="text" id="txtOffer" name="txtOffer" value="" maxlength="2">
              </div>
              <div class="col-md-12 form-group">
                <label>Client Email&nbsp;<span>*</span></span>&nbsp;<span id="errmsg"></span></label>
                <select class="form-control input-sm" id="txtOfferTaken" name="txtOfferTaken">
                  <?= getOptions($collection_user,'txtId','txtEmail','')?>
                </select>
              </div>
            </div>
            <div class="clear"></div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" id="close-offer-form">Close</button>
              <button class="btn btn-primary" type="button" id="btnSaveOffer" name="btnSaveOffer">
                <span style="display:none" id="createOffer_loading"></span>&nbsp;&nbsp;Save  
              </button>
            </div>
          </form>
        </div>
      </div>
  </div>
  <!-- Ppo-up To Create Promotional Offers End -->

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