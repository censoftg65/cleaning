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

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
$_SESSION['page_title'] = "Site Configuration | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

$site_config_id = "1";
if (!empty($site_config_id)) {
    $site_details = getSiteConfig($site_config_id);
    $site_config = $site_details[0];
}

?>

<div style="display:none;" id="msg-back-color"></div>
<?php include 'include/header.php' ?>
    
    <?php include 'include/left_menu.php' ?>

    <div class="col-md-9">
        <div class="col-md-12"><h4><strong>SITE INFORMATION</strong></h4></div>
        
        <form name="frmSiteInfo" id="frmSiteInfo" method="post">
            <input type="hidden" id="hidSiteInfoId" name="hidSiteInfoId" value="<?= $site_config_id?>">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <li class="subtab"><a class="subnav-selected">Site Info</a></li>
                  <li class="subtab"><a>Registration</a></li>
                  <li class="subtab"><a>Forgot Password</a></li>
                  <li class="subtab"><a>Discount Offer</a></li>
                  <li class="subtab"><a>Account Active/Deactive</a></li>
                </ul>
            </div>

            <div id="subtab-div0" class="col-md-12 extract-div">
                <div class=" extract-div">
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Name : </label>
                            <input type="text" class="form-control input-md" id="txtSiteName" name="txtSiteName" value="<?= $site_config['txtSiteName']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Address : </label>
                            <input type="text" class="form-control input-md" id="txtSiteAddress" value="<?= $site_config['txtSiteAddress']?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Language : </label>
                            <select class="form-control input-md" id="txtSiteLanguage" name="txtSiteLanguage">
                                <option value="<?= $site_config['txtSiteLanguage']?>"><?= $site_config['txtSiteLanguage']?></option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- SMTP Configuration start -->
                    <div class="col-md-12"><h6><strong>SMTP Mail Configutation Setting</strong></h6></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Host Name</label>
                            <input type="text" class="form-control input-md" id="txtSMTPhost" name="txtSMTPhost" value="<?= $site_config['txtSMTPhost']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Port Number</label>
                            <input type="text" class="form-control input-md" id="txtSMTPport" name="txtSMTPport" value="<?= $site_config['txtSMTPport']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control input-md" id="txtSMTPuname" name="txtSMTPuname" value="<?= $site_config['txtSMTPuname']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control input-md" id="txtSMTPpword" name="txtSMTPpword" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail From Name</label>
                            <input type="text" class="form-control input-md" id="txtSMTPfromname" name="txtSMTPfromname" value="<?= $site_config['txtSMTPfromname']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reply Mail</label>
                            <input type="text" class="form-control input-md" id="txtSMTPrplymail" name="txtSMTPrplymail" value="<?= $site_config['txtSMTPrplymail']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Add CC Mail</label>
                            <input type="text" class="form-control input-md" id="txtSMTPccmail" name="txtSMTPccmail" value="<?= $site_config['txtSMTPccmail']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Add BCC Mail</label>
                            <input type="text" class="form-control input-md" id="txtSMTPbccmail" name="txtSMTPbccmail" value="<?= $site_config['txtSMTPbccmail']?>">
                        </div>
                    </div>
                    <!-- SMTP Configuration end -->
                </div>
            </div>

            <!-- Registration SMTP setup start -->
            <div id="subtab-div1" class="col-md-12 extract-div" style="display: none">
                <div class=" extract-div">
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Subject</label>
                            <input type="text" class="form-control input-md" id="txtRegSub" name="txtRegSub" value="<?= $site_config['txtRegSub']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail From</label>
                            <input type="text" class="form-control input-md" id="txtRegMailFrom" name="txtRegMailFrom" value="<?= $site_config['txtRegMailFrom']?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mail Body</label>
                            <p>Use <b>[user_name]</b> & <b>[pass_word]</b> token as requires for sending the mail. Please make a single space on both the side af all tokens.</p>
                            <textarea class="form-control input-md" id="txtRegBody" name="txtRegBody"><?= $site_config['txtRegBody']?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mail Body For Admin</label>
                            <p>Use <b>[user_full_name]</b>, <b>[user_mail_id]</b> & <b>[user_phone_num]</b> token as requires for sending the mail. Please make a single space on both the side af all tokens.</p>
                            <textarea class="form-control input-md" id="txtRegAdminBody" name="txtRegAdminBody"><?= $site_config['txtRegAdminBody']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Registration SMTP setup end -->

            <!-- Forgot Password SMTP setup start -->
            <div id="subtab-div2" class="col-md-12 extract-div" style="display: none">
                <div class=" extract-div">
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Subject</label>
                            <input type="text" class="form-control input-md" id="txtForgotSub" name="txtForgotSub" value="<?= $site_config['txtForgotSub']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail From</label>
                            <input type="text" class="form-control input-md" id="txtForgotMailFrom" name="txtForgotMailFrom" value="<?= $site_config['txtForgotMailFrom']?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mail Body</label>
                            <p>Use <b>[user_name]</b> & <b>[reset_pass_link]</b> token as requires for sending the mail. Please make a single space on both the side af all tokens.</p>
                            <textarea class="form-control input-md" id="txtForgotBody" name="txtForgotBody"><?= $site_config['txtForgotBody']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Forgot Password SMTP setup end -->

            <!-- Discount Offer SMTP setup start -->
            <div id="subtab-div3" class="col-md-12 extract-div" style="display: none">
                <div class=" extract-div">
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Subject</label>
                            <input type="text" class="form-control input-md" id="txtOfferSub" name="txtOfferSub" value="<?= $site_config['txtOfferSub']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail From</label>
                            <input type="text" class="form-control input-md" id="txtOfferMailFrom" name="txtOfferMailFrom" value="<?= $site_config['txtOfferMailFrom']?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mail Body</label>
                            <textarea class="form-control input-md" id="txtOfferBody" name="txtOfferBody"><?= $site_config['txtOfferBody']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Discount Offer SMTP setup end -->

            <!-- Account Settings SMTP setup start -->
            <div id="subtab-div4" class="col-md-12 extract-div" style="display: none">
                <div class=" extract-div">
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Subject</label>
                            <input type="text" class="form-control input-md" id="txtAccountSub" name="txtAccountSub" value="<?= $site_config['txtAccountSub']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail From</label>
                            <input type="text" class="form-control input-md" id="txtAccountMailFrom" name="txtAccountMailFrom" value="<?= $site_config['txtAccountMailFrom']?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mail Body</label>
                            <textarea class="form-control input-md" id="txtAccountBody" name="txtAccountBody"><?= $site_config['txtAccountBody']?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mail Body For Admin</label>
                            <textarea class="form-control input-md" id="txtAccountAdminBody" name="txtAccountAdminBody"><?= $site_config['txtAccountAdminBody']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Account Settings SMTP setup end -->

            <!-- Account Settings SMTP setup start -->
            <div class="col-md-12 extract-div">
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-md btn-success" name="btnSiteInfo" id="btnSiteInfo">
                            <span style="display:none" id="siteinfo_loading"></span>&nbsp;&nbsp;Save Configuration
                        </button>
                    </div>
                </div>
                <div class="col-md-6 open-up-msg">
                    <div class="form-group">
                        <div id="site-info-success" title="Thank you" style="display: none">
                            Site configuration successfully updated
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>

    <?php include 'include/footer.php' ?>