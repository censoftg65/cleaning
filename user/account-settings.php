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

$_SESSION['page_title'] = "Account Settings | "._SITE_NAME;
$db = new Config(); 

if(!empty($uid)) {
    $user_profile = $objCommon->getUserProfile($uid);    
    $profile = $user_profile[0];
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
                        <h2 class="compHead">Account Settings</h2>
                    </div>
                   
                    <form name="frmAccSetting" id="frmAccSetting" method="post">
                        <input type="hidden" name="hidUserId" id="hidUserId" value="<?= $uid?>">
                    	<div class="col-sm-6">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="email" class="input-md" name="txtEmail" id="txtEmail" value="<?= $profile['txtEmail']?>" disabled />
                            </div>    
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="input-md" name="txtUsername" id="txtUsername" value="<?= $profile['txtUsername']?>" disabled />
                            </div>    
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="txtPassword" id="txtPassword" value="" />
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="input-md" name="txtNewPassword" id="txtNewPassword" value="" minlength="6" />
                            </div>
                        </div>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-sm-6">
                            <label><strong>Account Status</strong></label>
                            <div class="btn-group" data-toggle="buttons">
                                <?php if($profile['txtStatus'] == 1) { ?>
                                <label class="btn stat-btn active">
                                    <input type="radio" name='rdoStatus' id="rdoStatus" value="1">
                                    <span>Active (On)</span>
                                </label>
                                <label class="btn stat-btn">
                                    <input type="radio" name='rdoStatus' id="rdoStatus" value="-1">
                                    <span>De-active (Off)</span>
                                </label>
                                <?php } else { ?>
                                <label class="btn stat-btn">
                                    <input type="radio" name='rdoStatus' id="rdoStatus" value="1">
                                    <span>Active (On)</span>
                                </label>
                                <label class="btn stat-btn active">
                                    <input type="radio" name='rdoStatus' id="rdoStatus" value="-1">
                                    <span>De-active (Off)</span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>&nbsp;</label>
                            <div id="acc-succ-msg"></div>
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-6">
                            <div class="form-group pull-right">
                                <a href="my_profile.php">
                                    <button type="button" class="btn bt-md btn-default" name="btnAccCan" id="btnAccCan">Cancel</button>
                                </a>
                                &nbsp;&nbsp;
                                <button type="button" class="btn bt-md btn-success" name="btnAccount" id="btnAccount">
                                    <span style="display:none" id="user_acc_loading"></span> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php  include dirname(__DIR__).'/includes/user_footer.php'; ?>