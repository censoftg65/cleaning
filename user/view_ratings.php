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

$_SESSION['page_title'] = "View Ratings | "._SITE_NAME;
$db = new Config(); 

$collection = $objCommon->getAllRatings($uid);

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <section>
        <div class="container contentMain">
            <div class="row">
                
                <?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>

                <div class="col-sm-9 contentPart compServ">
                    <div class="col-sm-6">
                        <h2 class="compHead">Ratings</h2>
                    </div>

                    <div class="col-sm-6" id="com-msg-request" style="display: none"></div>

                    <div class="col-sm-12 table-responsive">
                        <form name="frmPendingService" id="frmPendingService" method="post">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Service Provider</th>
                                        <th>Comments</th>
                                        <th><center>#</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($collection as $rating) { ?>
                                    <tr>
                                        <td><?= $rating['txtServiceProvider']?></td>
                                        <td>
                                        <?php 
                                        echo strlen($rating['txtRatingComment']) >= 50 ? 
                                        substr($rating['txtRatingComment'], 0, 49).'&nbsp;<a id="read-more" data-id="'.$rating["txtId"].'">Read more</a>' :  
                                        $rating['txtRatingComment'];
                                        ?>
                                        </td>
                                        <td>
                                            <center>
                                                <button type="button" class="btn btn-xs btn-success" title="View Rating" id="btnRated" value="<?= $rating['txtId']?>">Rated</button>
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
                    <button type="button" class="btn btn-primary" name="btnSubEditRate" id="btnSubEditRate">Save</button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- End -->

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