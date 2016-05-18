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

$_SESSION['page_title'] = "Pending Services | "._SITE_NAME;
$db = new Config(); 

$collection = $objCommon->getPendingServices($uid);

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <section>
        <div class="container contentMain">
            <div class="row">
                
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>
                
                <div class="col-sm-9 contentPart compServ">
                    <div class="col-sm-6">
                        <h2 class="compHead">Pending Services</h2>
                    </div>

                    <div class="col-sm-6" id="msg-request" style="display: none"></div>

                    <div class="clear"></div>
                    <div class="col-sm-6">
                        <input type="text" name="txtSearch" id="txtSearch" placeholder="Sereach services here..." />
                    </div>
                    
                    <div class="col-sm-12 table-responsive">
                        <form name="frmPendingService" id="frmPendingService" method="post">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Cleaning Process</th>
                                        <th>Extra Services</th>
                                        <th>Service Date/Time</th>
                                        <th>Price</th>
                                        <th><center>#</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($collection as $pending) { ?>
                                    <tr>
                                        <td>
                                            <a class="view_booking" title="View Booking" data-id="<?= $pending['txtId']?>">
                                                <?= $pending['txtBedroom']."-BED,&nbsp;".$pending['txtBathroom']."-BATH"?></td>
                                            </a>
                                        <td>
                                        <?php 
                                        if ($pending['txtExtraService'] == '') {
                                            echo "Not Selected";
                                        } else {
                                            $services = explode(",", $pending['txtExtraService']);
                                            foreach ($services as $ex_service) {
                                                echo "&bull;&nbsp;".displayName(_DB_PREFIX."extra_services","txtServiceName",$ex_service,"txtId")."<br>";
                                            }
                                        }
                                        ?>
                                        </td>
                                        <td><?= $pending['txtServiceDate']."&nbsp;-&nbsp;".$pending['txtServiceTime']?></td>
                                        <td><?= "$&nbsp;".$pending['txtGrandTotal']?></td>
                                        <td>
                                            <center>
                                                <a href="update_booking.php?book_id=<?= base64_encode($pending['txtId'])?>">
                                                    <button type="button" class="btn btn-xs btn-default" title="Edit Booking" id="editBooking">
                                                        <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>
                                                <p></p>
                                                <button type="button" class="btn btn-xs btn-warning" title="Cancel Service" id="cancelService" value="<?= $pending['txtId']?>">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> Cancel
                                                </button>
                                            </center>
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
    </div>
