<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
$name = $_SESSION["txtFirstName"]." ".$_SESSION["txtLastName"];
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

require_once dirname(__DIR__).'/inc/config.inc.php';
require_once dirname(__DIR__).'/inc/function.inc.php';
require_once 'cls_common.php';

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/user/");
}

$_SESSION['page_title'] = "Completed Services | "._SITE_NAME;
$db = new Config(); 

$collection = $objCommon->getCompleteServices($uid);

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    

    <section>
        <div class="container contentMain">
            <div class="row">
                
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>
                
                <div class="col-sm-9 contentPart compServ">
                    <div class="col-sm-6">
                        <h2 class="compHead">Completed Services</h2>
                    </div>

                    <div class="col-sm-6" id="com-msg-request" style="display: none"></div>

                    <div class="clear"></div>
                    <div class="col-sm-6">
                        <input type="text" name="txtSearch" id="txtSearch" placeholder="Search services here..." />
                    </div>
                    
                    <div class="col-sm-12 table-responsive">
                        <form name="frmPendingService" id="frmPendingService" method="post">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Service Requestor</th>
                                        <th>Cleaning Process</th>
                                        <th>Extra Services</th>
                                        <th>Service Date/Time</th>
                                        <th>Price</th>
                                        <th><center>#</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($collection as $complete) { 
                                        $class = ($complete['txtAction'] == 'cancel') ? "warning" : "";
                                    ?>
                                    <tr class="<?= $class?>">
                                        <td><?= $complete['txtFirstName']." ".$complete['txtLastName']?></td>
                                        <td>
                                            <a class="view_booking" title="View Booking" data-id="<?= $complete['txtId']?>">
                                                <?= $complete['txtBedroom']."-BED,&nbsp;".$complete['txtBathroom']."-BATH"?>
                                            </a>
                                        </td>    
                                        <td>
                                        <?php 
                                        if ($complete['txtExtraService'] == '') {
                                            echo "Not Selected";
                                        } else {
                                            $services = explode(",", $complete['txtExtraService']);
                                            foreach ($services as $ex_service) {
                                                echo "&bull;&nbsp;".displayName(_DB_PREFIX."extra_services","txtServiceName",$ex_service,"txtId")."<br>";
                                            }
                                        }
                                        ?>
                                        </td>
                                        <td><?= $complete['txtServiceDate']."&nbsp;-&nbsp;".$complete['txtServiceTime']?></td>
                                        <td><?= "$&nbsp;".$complete['txtGrandTotal']?></td>
                                        <td>
                                            <center>
                                                <?php if ($complete['rateStatus'] == '1') { ?>
                                                <button type="button" class="btn btn-xs btn-success" title="View Rating" id="btnRated" value="<?= $complete['rateId']?>">Confirmed/Rated</button>
                                                <?php } else { ?>
                                                <button type="button" class="btn btn-xs btn-danger" title="Rate Service" id="btnRateUs" value="<?= $complete['txtId']?>">Job Completed/Rate-Us</button>
                                                <?php } ?>
                                            </center>
                                            <?php if ($complete['txtAction'] == 'cancel') { ?>
                                            <p>
                                            <center>
                                                <button type="button" class="btn btn-xs btn-warning">Canceled</button>
                                            </center>
                                            </p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($collection)) { ?>
                                    <tr class="no-record">
                                        <td colspan="10">Sorry..! No records found</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>


    <div>
        <div style="display:none;" id="back-color"></div>
        <div style="display:none;" id="cancel-service-loader"></div>
        <!-- Preview Booking Popup-->
        <div class="modal fade" id="book-preview" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" >Booking Preview</h3>
                    </div>
                    <div class="modal-body" style="padding-bottom:160px !important;">
                    </div>
                    <div class="clear"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End-->

        <!-- Submit Rating Form -->
        <div class="modal fade" id="rate-pop-up" style="display: none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Rate Service</h3>
                    </div>
                    <form name="frmRating" id="frmRating" method="post">
                    <div>
                        <input type="hidden" name="book_id" id="book_id" value="">
                        <input type="hidden" name="txtRating" id="txtRating" value="">
                    </div>
                    <div id="body-rate"  class="modal-body" style="padding-bottom:160px !important;"></div>
                    </form>
                    <div class="clear"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" name="btnSubRate" id="btnSubRate">
                            <span class="rate-service-loader"></span> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->

        <!-- Edit Submitted Rating Form -->
        <div class="modal fade" id="rated-pop-up" style="display: none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title">Rate Service</h3>
                    </div>
                    <form name="frmRatingEdit" id="frmRatingEdit" method="post">
                    <div>
                        <input type="hidden" name="rate_id" id="rate_id" value="">
                        <input type="hidden" name="txtRatingEdit" id="txtRatingEdit" value="">
                        <input type="hidden" name="get_edit_rate" id="get_edit_rate" value="EditRating">
                    </div>
                    <div id="body-edit-rate" class="modal-body" style="padding-bottom:160px !important;"></div>
                    </form>
                    <div class="clear"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" name="btnSubEditRate" id="btnSubEditRate">
                            <span class="rate-service-loader"></span> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->
    </div>

