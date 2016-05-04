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
include_once 'cls_common.php';

if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/user/");
}

$_SESSION['page_title'] = "My Profile | "._SITE_NAME;
$db = new Config(); 
$collection_city = $objCommon->getCities();
$collection_zips = $objCommon->getZipCodes();

if(!empty($uid)) {
    $user_profile = $objCommon->getUserProfile($uid);    
    $profile = $user_profile[0];
    // pr($profile);
}

?>

<?php include dirname(__DIR__).'/includes/head.php'; ?>

    <?php  include dirname(__DIR__).'/includes/user_header.php'; ?>

    <section>
    	<div class="container contentMain">
            <div class="row">

            	<?php  include dirname(__DIR__).'/includes/user_leftmenu.php'; ?>

                <div class="col-sm-9 contentPart">
                    <div class="col-sm-12">
                        <h2 class="compHead">My Profile</h2>
                    </div>
                    
                    <form name="frmUserProfile" id="frmUserProfile" method="post" action="form-wizard/processProfile.php">
                    	<input type="hidden" name="hidUserId" id="hidUserId" value="<?= $uid?>">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="input-md" name="txtFirstName" id="txtFirstName" placeholder="First Name" value="<?= $profile['txtFirstName']?>" />
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="input-md" name="txtLastName" id="txtLastName" placeholder="Last Name" value="<?= $profile['txtLastName']?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-mail Address</label>
                                <input type="email" class="input-md" name="txtEmail" id="txtEmail" placeholder="Email Id" value="<?= $profile['txtEmail']?>" readonly="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="input-md" name="txtPhone" id="txtPhone" placeholder="Phone Number" value="<?= $profile['txtPhone']?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address Line 1</label>
                                <input type="text" class="input-md" name="txtAddressLine1" id="txtAddressLine1" placeholder="Address Line 1" value="<?= $profile['txtAddressLine1']?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address Line 1</label>
                                <input type="text" class="input-md" name="txtAddressLine2" id="txtAddressLine2" placeholder="Address Line 2" value="<?= $profile['txtAddressLine2']?>" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="input-md" name="txtCountry" id="txtCountry" value="<?= $profile['txtCountry']?>" readonly="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" class="input-md" name="txtState" id="txtState" value="<?= $profile['txtState']?>" readonly="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <select class="input-md" id="txtCity" name="txtCity">
                                    <?php getOptions($collection_city,'txtCity','txtCity',$profile['txtCity'])?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <select class="input-md" id="txtZipcode" name="txtZipcode">
                                    <?php //getOptions($collection_zips,'txtZip','txtZip',$profile['txtZipcode'])?>
                                    <option value="0">-- Select --</option>
                                    <option value="<?= $profile['txtZipcode']?>" selected><?= $profile['txtZipcode']?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group pull-right">
                                <input type="submit" class="btn bt-md btn-success" name="btnProfile" id="btnProfile" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>
