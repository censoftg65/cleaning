<?php
session_start();

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
include_once dirname(__DIR__).'/pages/cls_pages.php';
include_once 'cls_user.php';
$_SESSION['page_title'] = "Forgot Password | "._SITE_NAME;
$db = new Config(); 

?>

<?php include dirname(__DIR__).'/includes/header.php';?>

<body class="inner">
    <div id="wrapper">
        
        <?php include_once(_INCLUDE_PATH.'/header-menu.php');?>
        
        <div style="margin-top:200px !important;"></div>
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_form">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-centered">
                    <h2><strong>Forgot Password</strong></h2>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 log_box">
                
                <div id="succ-resp" class="col-md-12 response col-centered"></div>

                <form name="frmForpass" id="frmForpass" method="post">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 col-centered">
                        <div>&nbsp;</div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
                                <input class="form-control input-lg" type="text" id="txtEmail" name="txtEmail" value="<?= $db->getParam('txtEmail')?>" required="" placeholder="E-mail Id">
                            </div>
                        </div>
                        <div>&nbsp;</div>
                        
                        <div class="form-group pull-left">
                            <div>
                                Have an account? 
                                <a href="<?= _SITE_URL?>/user/login.php">Click here</a>
                            </div>
                            <div>
                                Not a member yet?
                                <a href="<?= _SITE_URL?>/user/register.php">Click here</a>
                            </div>
                        </div>

                        <div class="form-group card-actionbar-row pull-right">
                            <button type="button" class="btn btn-lg btn-primary" id="btnForPass" name="btnForPass">
                                <span style="display:none" id="reg_user_loading"></span>&nbsp;Submit Here
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </form>
            </div>
        </div>
        
    </div>   

    <?php include_once(_INCLUDE_PATH.'/footer-upper-grid.php'); ?>
    
<?php include_once(_INCLUDE_PATH.'/footer.php'); ?>