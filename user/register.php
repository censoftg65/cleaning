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

require_once dirname(__DIR__).'/inc/config.inc.php';
require_once dirname(__DIR__).'/inc/function.inc.php';
include_once dirname(__DIR__).'/pages/cls_pages.php';
include_once 'cls_user.php';
$_SESSION['page_title'] = "Registration | "._SITE_NAME;
$db = new Config(); 

$collection_city = $objUser->getCities();
$collection_zips = $objUser->getZipCodes();

?>

<?php include dirname(__DIR__).'/includes/header.php';?>

<body class="inner">
    <div id="wrapper">
        <?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
        
        <div style="margin-top:200px !important;"></div>

        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_form">
                <h2><strong>Registration Form</strong></h2>
            </div>
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_box">
                <form data-toggle="validator" role="form" id="frm-registration" method="post" action="">
                    <div id="succ-resp" class="response alert-callout"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">First Name&nbsp;<span>*</span></label>
                                <input type="text" class="form-control" id="txtFirstName" name="txtFirstName"  data-rule-minlength="6" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Last Name&nbsp;<span class>*</span></label>
                                <input type="text" class="form-control" id="txtLastName" name="txtLastName" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Address Line1&nbsp;<span class>*</span></label>
                                <input type="text" class="form-control" id="txtAddressLine1" name="txtAddressLine1" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Address Line2</label>
                                <input type="text" class="form-control" id="txtAddressLine2" name="txtAddressLine2" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <input type="text" class="form-control" id="txtCountry" name="txtCountry" value="USA" readOnly />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">State/Province</label>
                                <input type="text" class="form-control" id="txtState" name="txtState" value="NY" readOnly />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">City&nbsp;<span class>*</span></label>
                                <select id="txtCity" name="txtCity" class="form-control" required="" >
                                    <?php getOptions($collection_city,'txtCity','txtCity','')?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Zip code&nbsp;<span class>*</span></label>
                                <select id="txtZipcode" name="txtZipcode" class="form-control" required>
                                    <?php getOptions($collection_zips,'txtZip','txtZip','')?>
                                    <!-- <option value='0'> -- Select -- </option> -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Email Id&nbsp;<span class>*</span></label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Phone&nbsp;<span class>*</span>&nbsp;<span class="errmsg"></span></label>
                                <input type="text" class="form-control" id="txtPhone" name="txtPhone" required="" maxlength="15">
                            </div>
                        </div>
                    </div>

                    <div class="form-group card-actionbar-row pull-right">
                        <button type="button" class="btn btn-primary" id="btnRegister" name="btnRegister">
                            <span style="display:none" id="reg_user_loading"></span>&nbsp;Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>   

    <?php include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
    
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>