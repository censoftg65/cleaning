<?php
/*register.php
* This file for User Registration
*/
?>

<?php
/*--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites*/
foreach($_GET as $get_key => $get_value) {
if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
    if(isset($_GET[$get_key])) unset($_GET[$get_key]);
    die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
}
}
?>
<?php require_once(dirname(__DIR__).'/inc/config.inc.php');?>
<?php include_once(dirname(__DIR__).'/pages/cls_pages.php');?>
<?php $_SESSION['page_title'] = "User Registration";?><!-- Show page title -->
<?php include_once(_INCLUDE_PATH.'/header.php');?>

<!-- THIS CSS FOR BOOKING FORM -->
<link href="<?= _CSS_URL ?>/booking-awesome.css" rel="stylesheet">
<!-- END THIS CSS FOR BOOKING FORM -->

<script src="<?= _BOOKING_URL ?>/js/booking.js"></script>
<script src="<?= _USER_URL ?>/js/registration.js"></script>


<?php include_once(_BOOKING_PATH.'/cls_common.php');?>

<body class="inner">
<div id="wrapper">
    <?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
    <div style="margin-top:140px !important;"></div>

    <!-- complete-registration-form -->

    <div class="complete-registration-form">
        <div class="col-lg-12">
        <!-- Response Come Here -->
        <div id="succ-resp" class="response alert alert-callout" style="margin-bottom:0 !important;"></div>
        <!--End Response Come -->
            <form class="form-horizontal form-validation" id="frm-registration" role="form" method="post">
                <br/>
                <br/>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txtFirstname" class="col-sm-4 control-label">Firstname</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="txtFirstname" name="txtFirstname"  data-rule-minlength="6" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txtLastname" class="col-sm-4 control-label">Lastname</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="txtLastname" name="txtLastname" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txtAddressLine1" class="col-sm-4 control-label">Address Line1</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="txtAddressLine1" name="txtAddressLine1" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txtAddressLine2" class="col-sm-4 control-label">Address Line2</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="txtAddressLine2" name="txtAddressLine2" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txtCountry" class="col-sm-4 control-label">Country</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="txtCountry" name="txtCountry" value="USA" readOnly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txtState" class="col-sm-4 control-label">State/Provience</label>
                                    <div class="col-sm-8">
                                        <select id="txtState" name="txtState" class="form-control" required="" >
                                            <option value="">(please select)</option>
                                            <?php $USSates= $USStateListingObj->getUSStateListing(); ?>
                                            <?php foreach ($USSates as $value):?>
                                            <option value="<?= $value['txtAbbreviation']?>">
                                                <?= $value['txtState'] ?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="txtCity" class="col-sm-4 control-label">City</label>
                                <div class="col-sm-8">
                                    <select id="txtCity" name="txtCity" class="form-control" required="" >
                                        <option value="">(please select)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="txtZipcode" class="col-sm-4 control-label">Zip code</label>
                                <div class="col-sm-8">
                                    <select id="txtZipcode" name="txtZipcode" class="form-control" required>
                                        <option value="">(please select)</option>
                                        <option value="00501">00501</option>
                                        <option value="00502">00502</option>
                                        <option value="00503">00503</option>
                                        <option value="00504">00504</option>
                                        <option value="00505">00505</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="txtEmail" class="col-sm-4 control-label">Email Id</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="txtPhone" class="col-sm-4 control-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="txtPhone" name="txtPhone" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .card-body -->
                <div class="card-actionbar">
                    <div class="card-actionbar-row">
                        <button type="button" class="btn-registration btn btn-primary">Register</button>
                    </div>
                </div>
            </div> <!--end .card -->
        </form>
     </div> <!--end .col -->
</div>
<!--end .row -->

<!-- complete-registration-form -->

<?php include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>