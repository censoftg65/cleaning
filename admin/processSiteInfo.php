<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"]; 

require_once dirname(__DIR__).'/inc/config.inc.php';
include_once dirname(__DIR__).'/inc/function.inc.php';
include_once 'cls_classes.php';
$db = new Config();

$site_info_id 		= $db->getParam('info_id');
$arr_config['txtSiteName'] 			= $db->getParam('site_name');
$arr_config['txtSiteLanguage'] 		= $db->getParam('site_lang');
$arr_config['txtSMTPhost'] 			= $db->getParam('site_host');
$arr_config['txtSMTPport'] 			= $db->getParam('site_port');
$arr_config['txtSMTPuname'] 		= $db->getParam('site_uname');
$arr_config['txtSMTPpword'] 		= $db->getParam('site_pword');
$arr_config['txtSMTPfromname'] 		= $db->getParam('site_fromname');
$arr_config['txtSMTPrplymail'] 		= $db->getParam('site_replymail');
$arr_config['txtSMTPccmail'] 		= $db->getParam('site_ccmail');
$arr_config['txtSMTPbccmail'] 		= $db->getParam('site_bccmail');
$arr_config['txtRegSub']			= $db->getParam('site_reg_sub');
$arr_config['txtRegMailFrom'] 		= $db->getParam('site_reg_mailfrom');
$arr_config['txtRegBody']			= $db->getParam('site_reg_body');
$arr_config['txtRegAdminBody'] 		= $db->getParam('site_reg_adminbody');
$arr_config['txtForgotSub']			= $db->getParam('site_forgot_sub');
$arr_config['txtForgotMailFrom']	= $db->getParam('site_forgot_mailfrom');
$arr_config['txtForgotBody']		= $db->getParam('site_forgot_body');
$arr_config['txtForgotAdminBody']	= $db->getParam('site_forgot_adminbody');
$arr_config['txtOfferSub']			= $db->getParam('site_offer_sub');
$arr_config['txtOfferMailFrom']		= $db->getParam('site_offer_mailfrom');
$arr_config['txtOfferBody']			= $db->getParam('site_offer_body');
$arr_config['txtOfferAdminBody']	= $db->getParam('site_offer_adminbody');
$arr_config['txtAccountSub']		= $db->getParam('site_account_sub');
$arr_config['txtAccountMailFrom']	= $db->getParam('site_account_mailfrom');
$arr_config['txtAccountBody']		= $db->getParam('site_account_body');
$arr_config['txtAccountAdminBody']	= $db->getParam('site_account_adminbody');

if (empty($smtp_pword)) {
	$objSite->setAdminConfig($arr_config);
	$objSite->updateConfigWthOutPass($site_info_id);
} else {
	$objSite->setAdminConfig($arr_config);
	$objSite->updateConfigWthPass($site_info_id);
}
?>